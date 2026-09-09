<?php
/**
 * ODN Studio — custom in-site admin dashboard for ODN Prints.
 *
 * Runs inside WordPress, so it talks to WooCommerce through its own PHP API
 * (no external REST key needed). All endpoints are gated by the
 * `manage_woocommerce` capability + the WordPress REST nonce, so only a
 * logged-in store manager/admin can use them. No secrets live in client code.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ------------------------------------------------------------------ *
 * 1) Admin menu page
 * ------------------------------------------------------------------ */
add_action( 'admin_menu', function () {
	add_menu_page(
		'ODN Studio',
		'ODN Studio',
		'manage_woocommerce',
		'odn-studio',
		'odn_studio_render_page',
		'dashicons-store',
		3
	);
} );

/* ------------------------------------------------------------------ *
 * 2) REST endpoints (odn/v1)
 * ------------------------------------------------------------------ */
add_action( 'rest_api_init', function () {
	$perm = function () { return current_user_can( 'manage_woocommerce' ); };

	register_rest_route( 'odn/v1', '/stats', array(
		array( 'methods' => 'GET', 'callback' => 'odn_rest_stats', 'permission_callback' => $perm ),
	) );
	register_rest_route( 'odn/v1', '/products', array(
		array( 'methods' => 'GET',  'callback' => 'odn_rest_products_list', 'permission_callback' => $perm ),
		array( 'methods' => 'POST', 'callback' => 'odn_rest_product_create', 'permission_callback' => $perm ),
	) );
	register_rest_route( 'odn/v1', '/products/(?P<id>\d+)', array(
		array( 'methods' => 'POST',   'callback' => 'odn_rest_product_update', 'permission_callback' => $perm ),
		array( 'methods' => 'DELETE', 'callback' => 'odn_rest_product_delete', 'permission_callback' => $perm ),
	) );
	register_rest_route( 'odn/v1', '/orders', array(
		array( 'methods' => 'GET', 'callback' => 'odn_rest_orders_list', 'permission_callback' => $perm ),
	) );
	register_rest_route( 'odn/v1', '/orders/(?P<id>\d+)/status', array(
		array( 'methods' => 'POST', 'callback' => 'odn_rest_order_status', 'permission_callback' => $perm ),
	) );
} );

function odn_wc_ready() { return class_exists( 'WooCommerce' ) && function_exists( 'wc_get_products' ); }

/* --------------------------- Stats -------------------------------- */
function odn_rest_stats() {
	if ( ! odn_wc_ready() ) { return new WP_Error( 'no_wc', 'WooCommerce not active', array( 'status' => 400 ) ); }
	$prod_count = (int) wp_count_posts( 'product' )->publish;
	$paid = wc_get_orders( array( 'limit' => -1, 'status' => array( 'wc-processing', 'wc-completed', 'wc-on-hold' ), 'return' => 'ids' ) );
	$revenue = 0;
	foreach ( wc_get_orders( array( 'limit' => 200, 'status' => array( 'wc-processing', 'wc-completed' ) ) ) as $o ) {
		$revenue += (float) $o->get_total();
	}
	$all = wc_get_orders( array( 'limit' => -1, 'return' => 'ids' ) );
	return array(
		'products'   => $prod_count,
		'orders'     => count( $all ),
		'open'       => count( $paid ),
		'revenue'    => $revenue,
		'currency'   => get_woocommerce_currency_symbol(),
	);
}

/* -------------------------- Products ------------------------------ */
function odn_product_out( $p ) {
	$cats = array();
	foreach ( wp_get_post_terms( $p->get_id(), 'product_cat' ) as $t ) { $cats[] = $t->name; }
	return array(
		'id'         => $p->get_id(),
		'name'       => $p->get_name(),
		'price'      => $p->get_regular_price(),
		'status'     => $p->get_status(),
		'type'       => $p->get_type(),
		'sku'        => $p->get_sku(),
		'categories' => $cats,
		'permalink'  => get_permalink( $p->get_id() ),
		'image'      => wp_get_attachment_image_url( $p->get_image_id(), 'thumbnail' ),
	);
}
function odn_rest_products_list() {
	if ( ! odn_wc_ready() ) { return new WP_Error( 'no_wc', 'WooCommerce not active', array( 'status' => 400 ) ); }
	$out = array();
	foreach ( wc_get_products( array( 'limit' => 100, 'orderby' => 'date', 'order' => 'DESC' ) ) as $p ) {
		$out[] = odn_product_out( $p );
	}
	return $out;
}
function odn_category_id( $name ) {
	$name = trim( $name );
	if ( '' === $name ) { return 0; }
	$term = term_exists( $name, 'product_cat' );
	if ( ! $term ) { $term = wp_insert_term( $name, 'product_cat' ); }
	if ( is_wp_error( $term ) ) { return 0; }
	return is_array( $term ) ? (int) $term['term_id'] : (int) $term;
}
function odn_rest_product_create( WP_REST_Request $req ) {
	if ( ! odn_wc_ready() ) { return new WP_Error( 'no_wc', 'WooCommerce not active', array( 'status' => 400 ) ); }
	$b = $req->get_json_params();
	$name = isset( $b['name'] ) ? sanitize_text_field( $b['name'] ) : '';
	if ( '' === $name ) { return new WP_Error( 'bad', 'Name is required', array( 'status' => 422 ) ); }
	$product = new WC_Product_Simple();
	$product->set_name( $name );
	$product->set_status( ! empty( $b['publish'] ) ? 'publish' : 'draft' );
	$product->set_catalog_visibility( 'visible' );
	if ( isset( $b['description'] ) ) { $product->set_description( wp_kses_post( $b['description'] ) ); }
	if ( isset( $b['short'] ) )       { $product->set_short_description( wp_kses_post( $b['short'] ) ); }
	if ( isset( $b['price'] ) && '' !== $b['price'] ) { $product->set_regular_price( (string) floatval( $b['price'] ) ); }
	$product->set_manage_stock( false );
	$product->set_sold_individually( false );
	if ( ! empty( $b['category'] ) ) {
		$cid = odn_category_id( $b['category'] );
		if ( $cid ) { $product->set_category_ids( array( $cid ) ); }
	}
	if ( ! empty( $b['image_id'] ) ) { $product->set_image_id( (int) $b['image_id'] ); }
	$id = $product->save();
	if ( ! $id ) { return new WP_Error( 'fail', 'Could not create product', array( 'status' => 500 ) ); }
	return odn_product_out( wc_get_product( $id ) );
}
function odn_rest_product_update( WP_REST_Request $req ) {
	if ( ! odn_wc_ready() ) { return new WP_Error( 'no_wc', 'WooCommerce not active', array( 'status' => 400 ) ); }
	$p = wc_get_product( (int) $req['id'] );
	if ( ! $p ) { return new WP_Error( 'nf', 'Product not found', array( 'status' => 404 ) ); }
	$b = $req->get_json_params();
	if ( isset( $b['name'] ) )   { $p->set_name( sanitize_text_field( $b['name'] ) ); }
	if ( isset( $b['price'] ) )  { $p->set_regular_price( (string) floatval( $b['price'] ) ); }
	if ( isset( $b['status'] ) && in_array( $b['status'], array( 'publish', 'draft' ), true ) ) { $p->set_status( $b['status'] ); }
	$p->save();
	return odn_product_out( wc_get_product( (int) $req['id'] ) );
}
function odn_rest_product_delete( WP_REST_Request $req ) {
	if ( ! odn_wc_ready() ) { return new WP_Error( 'no_wc', 'WooCommerce not active', array( 'status' => 400 ) ); }
	$p = wc_get_product( (int) $req['id'] );
	if ( ! $p ) { return new WP_Error( 'nf', 'Product not found', array( 'status' => 404 ) ); }
	$p->delete( false ); // move to trash
	return array( 'deleted' => (int) $req['id'] );
}

/* --------------------------- Orders ------------------------------- */
function odn_rest_orders_list() {
	if ( ! odn_wc_ready() ) { return new WP_Error( 'no_wc', 'WooCommerce not active', array( 'status' => 400 ) ); }
	$out = array();
	foreach ( wc_get_orders( array( 'limit' => 40, 'orderby' => 'date', 'order' => 'DESC' ) ) as $o ) {
		$items = array();
		foreach ( $o->get_items() as $it ) {
			$items[] = array( 'name' => $it->get_name(), 'qty' => $it->get_quantity() );
		}
		$out[] = array(
			'id'       => $o->get_id(),
			'number'   => $o->get_order_number(),
			'date'     => $o->get_date_created() ? $o->get_date_created()->date( 'j M Y' ) : '',
			'status'   => $o->get_status(),
			'total'    => $o->get_total(),
			'currency' => get_woocommerce_currency_symbol( $o->get_currency() ),
			'customer' => trim( $o->get_billing_first_name() . ' ' . $o->get_billing_last_name() ),
			'email'    => $o->get_billing_email(),
			'phone'    => $o->get_billing_phone(),
			'items'    => $items,
			'edit'     => admin_url( 'post.php?post=' . $o->get_id() . '&action=edit' ),
		);
	}
	return $out;
}
function odn_rest_order_status( WP_REST_Request $req ) {
	if ( ! odn_wc_ready() ) { return new WP_Error( 'no_wc', 'WooCommerce not active', array( 'status' => 400 ) ); }
	$o = wc_get_order( (int) $req['id'] );
	if ( ! $o ) { return new WP_Error( 'nf', 'Order not found', array( 'status' => 404 ) ); }
	$b = $req->get_json_params();
	$status = isset( $b['status'] ) ? sanitize_key( $b['status'] ) : '';
	$allowed = array( 'pending', 'processing', 'on-hold', 'completed', 'cancelled', 'refunded' );
	if ( ! in_array( $status, $allowed, true ) ) { return new WP_Error( 'bad', 'Invalid status', array( 'status' => 422 ) ); }
	$o->update_status( $status, 'Updated from ODN Studio. ' );
	return array( 'id' => (int) $req['id'], 'status' => $status );
}

/* ------------------------------------------------------------------ *
 * 3) The dashboard page (self-contained HTML + CSS + JS)
 * ------------------------------------------------------------------ */
function odn_studio_render_page() {
	$boot = array(
		'root'  => esc_url_raw( rest_url( 'odn/v1/' ) ),
		'nonce' => wp_create_nonce( 'wp_rest' ),
		'wc'    => odn_wc_ready(),
		'media' => admin_url( 'upload.php' ),
	);
	?>
	<div class="wrap">
	<div id="odn-studio">
		<div class="odn-a-head">
			<h1>ODN Studio</h1>
			<nav class="odn-a-tabs">
				<button class="odn-a-tab on" data-tab="dash">Dashboard</button>
				<button class="odn-a-tab" data-tab="orders">Orders</button>
				<button class="odn-a-tab" data-tab="products">Products</button>
			</nav>
		</div>
		<div id="odn-a-msg" class="odn-a-msg" hidden></div>
		<section class="odn-a-panel" data-panel="dash"></section>
		<section class="odn-a-panel" data-panel="orders" hidden></section>
		<section class="odn-a-panel" data-panel="products" hidden></section>
	</div>
	</div>

	<style>
	#odn-studio{--a-bg:#0f1115;--a-card:#171a20;--a-line:#262b34;--a-txt:#e9ecf2;--a-dim:#98a0ae;--a-amber:#f4b53f;--a-amber2:#e07a3a;
		background:var(--a-bg);color:var(--a-txt);margin:20px 20px 20px 0;border:1px solid var(--a-line);border-radius:16px;padding:22px 24px;
		font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif}
	#odn-studio h1{color:var(--a-txt);font-size:1.5rem;margin:0}
	.odn-a-head{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:20px}
	.odn-a-tabs{display:flex;gap:8px}
	.odn-a-tab{background:var(--a-card);border:1px solid var(--a-line);color:var(--a-dim);padding:9px 18px;border-radius:999px;cursor:pointer;font-size:.9rem}
	.odn-a-tab.on{background:var(--a-amber);border-color:var(--a-amber);color:#0b0b0b;font-weight:600}
	.odn-a-msg{padding:11px 14px;border-radius:10px;margin-bottom:16px;font-size:.9rem;border:1px solid var(--a-line);background:var(--a-card)}
	.odn-a-msg.ok{border-left:4px solid var(--a-amber)}
	.odn-a-msg.err{border-left:4px solid #ff8e7a}
	.odn-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:14px}
	.odn-stat{background:var(--a-card);border:1px solid var(--a-line);border-radius:14px;padding:20px}
	.odn-stat b{display:block;font-size:2rem;line-height:1;margin-bottom:6px}
	.odn-stat span{color:var(--a-dim);font-size:.8rem;text-transform:uppercase;letter-spacing:.08em}
	.odn-a-card{background:var(--a-card);border:1px solid var(--a-line);border-radius:14px;padding:18px 20px;margin-top:16px}
	.odn-a-card h2{color:var(--a-txt);font-size:1.1rem;margin:0 0 14px}
	table.odn-t{width:100%;border-collapse:collapse;font-size:.9rem}
	table.odn-t th,table.odn-t td{text-align:left;padding:11px 10px;border-bottom:1px solid var(--a-line);vertical-align:top}
	table.odn-t th{color:var(--a-dim);font-weight:600;font-size:.76rem;text-transform:uppercase;letter-spacing:.05em}
	.odn-badge{display:inline-block;padding:3px 10px;border-radius:999px;font-size:.72rem;border:1px solid var(--a-line);background:var(--a-bg);color:var(--a-dim)}
	.odn-badge.processing,.odn-badge.publish{color:var(--a-amber);border-color:var(--a-amber)}
	.odn-badge.completed{color:#7fd88f;border-color:#3f6b48}
	.odn-a-btn{background:var(--a-amber);border:0;color:#0b0b0b;font-weight:600;padding:10px 18px;border-radius:10px;cursor:pointer;font-size:.88rem}
	.odn-a-btn.ghost{background:transparent;border:1px solid var(--a-line);color:var(--a-txt)}
	.odn-a-btn.sm{padding:6px 12px;font-size:.8rem}
	.odn-a-btn.danger{background:transparent;border:1px solid #6b3b34;color:#ff8e7a}
	.odn-form{display:grid;gap:12px;max-width:560px}
	.odn-form label{display:block;font-size:.82rem;color:var(--a-dim);margin-bottom:5px}
	.odn-form input,.odn-form textarea,.odn-form select{width:100%;padding:10px 12px;background:var(--a-bg);border:1px solid var(--a-line);border-radius:9px;color:var(--a-txt);font:inherit}
	.odn-form .row2{display:grid;grid-template-columns:1fr 1fr;gap:12px}
	.odn-empty{color:var(--a-dim);padding:26px;text-align:center;border:1px dashed var(--a-line);border-radius:12px}
	.odn-sel{background:var(--a-bg);border:1px solid var(--a-line);color:var(--a-txt);border-radius:8px;padding:6px 8px;font-size:.82rem}
	.odn-muted{color:var(--a-dim);font-size:.82rem}
	</style>

	<script>
	(function(){
		var B=<?php echo wp_json_encode( $boot ); ?>;
		var $=function(s,r){return (r||document).querySelector(s)};
		var msg=$('#odn-a-msg');
		function flash(t,ok){msg.textContent=t;msg.className='odn-a-msg '+(ok?'ok':'err');msg.hidden=false;setTimeout(function(){msg.hidden=true;},4000);}
		function api(path,opts){opts=opts||{};opts.headers=Object.assign({'Content-Type':'application/json','X-WP-Nonce':B.nonce},opts.headers||{});
			return fetch(B.root+path,opts).then(function(r){return r.json().then(function(j){if(!r.ok){throw (j&&j.message)||('Error '+r.status);}return j;});});}
		var money=function(n){return B_cur()+Number(n||0).toLocaleString('en-IN');};
		var CUR='₹'; function B_cur(){return CUR;}
		function esc(s){return String(s==null?'':s).replace(/[&<>"]/g,function(c){return{'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c];});}

		/* tabs */
		document.querySelectorAll('.odn-a-tab').forEach(function(t){t.addEventListener('click',function(){
			document.querySelectorAll('.odn-a-tab').forEach(function(x){x.classList.toggle('on',x===t);});
			document.querySelectorAll('.odn-a-panel').forEach(function(p){p.hidden=p.dataset.panel!==t.dataset.tab;});
			load(t.dataset.tab);
		});});

		if(!B.wc){document.querySelector('[data-panel="dash"]').innerHTML='<div class="odn-empty">WooCommerce is not active — activate it to use the dashboard.</div>';return;}

		function load(tab){ if(tab==='dash')loadDash(); else if(tab==='orders')loadOrders(); else if(tab==='products')loadProducts(); }

		/* Dashboard */
		function loadDash(){var el=$('[data-panel="dash"]');el.innerHTML='<div class="odn-muted">Loading…</div>';
			api('stats').then(function(s){CUR=s.currency||'₹';
				el.innerHTML='<div class="odn-stats">'+
					stat(s.products,'Products')+stat(s.orders,'Orders')+stat(s.open,'Open orders')+stat(money(s.revenue),'Revenue')+'</div>'+
					'<div class="odn-a-card"><h2>Quick actions</h2>'+
					'<button class="odn-a-btn" id="odn-goadd">+ Add a product</button> '+
					'<button class="odn-a-btn ghost" id="odn-goorders">View orders</button></div>';
				$('#odn-goadd').onclick=function(){gotab('products');};
				$('#odn-goorders').onclick=function(){gotab('orders');};
			}).catch(function(e){el.innerHTML='<div class="odn-empty">'+esc(e)+'</div>';});}
		function stat(v,l){return '<div class="odn-stat"><b>'+esc(v)+'</b><span>'+esc(l)+'</span></div>';}
		function gotab(t){var b=document.querySelector('.odn-a-tab[data-tab="'+t+'"]');if(b)b.click();}

		/* Orders */
		var ORDER_STATUSES=['pending','processing','on-hold','completed','cancelled','refunded'];
		function loadOrders(){var el=$('[data-panel="orders"]');el.innerHTML='<div class="odn-muted">Loading…</div>';
			api('orders').then(function(list){
				if(!list.length){el.innerHTML='<div class="odn-a-card"><h2>Orders</h2><div class="odn-empty">No orders yet. They’ll appear here once customers check out.</div></div>';return;}
				var rows=list.map(function(o){
					var opts=ORDER_STATUSES.map(function(s){return '<option value="'+s+'"'+(s===o.status?' selected':'')+'>'+s+'</option>';}).join('');
					var items=o.items.map(function(i){return esc(i.qty+'× '+i.name);}).join('<br>');
					return '<tr><td>#'+esc(o.number)+'<br><span class="odn-muted">'+esc(o.date)+'</span></td>'+
						'<td>'+esc(o.customer||'—')+'<br><span class="odn-muted">'+esc(o.email||'')+'</span></td>'+
						'<td>'+items+'</td><td>'+esc(o.currency)+esc(o.total)+'</td>'+
						'<td><select class="odn-sel" data-oid="'+o.id+'">'+opts+'</select></td>'+
						'<td><a class="odn-a-btn ghost sm" href="'+esc(o.edit)+'">Open</a></td></tr>';
				}).join('');
				el.innerHTML='<div class="odn-a-card"><h2>Orders</h2><table class="odn-t"><thead><tr><th>Order</th><th>Customer</th><th>Items</th><th>Total</th><th>Status</th><th></th></tr></thead><tbody>'+rows+'</tbody></table></div>';
				el.querySelectorAll('[data-oid]').forEach(function(sel){sel.addEventListener('change',function(){
					api('orders/'+sel.dataset.oid+'/status',{method:'POST',body:JSON.stringify({status:sel.value})})
						.then(function(){flash('Order #'+sel.dataset.oid+' → '+sel.value,true);})
						.catch(function(e){flash(e,false);});
				});});
			}).catch(function(e){el.innerHTML='<div class="odn-empty">'+esc(e)+'</div>';});}

		/* Products */
		function loadProducts(){var el=$('[data-panel="products"]');el.innerHTML='<div class="odn-muted">Loading…</div>';
			api('products').then(function(list){
				var form='<div class="odn-a-card"><h2>Add a product</h2><div class="odn-form">'+
					'<div><label>Name</label><input id="np-name" placeholder="Custom Resin Figurine"></div>'+
					'<div class="row2"><div><label>Price (₹)</label><input id="np-price" type="number" min="0" step="1" placeholder="1299"></div>'+
					'<div><label>Category</label><input id="np-cat" placeholder="3D Models"></div></div>'+
					'<div><label>Short description</label><textarea id="np-short" rows="2"></textarea></div>'+
					'<div><label>Image ID (from Media library, optional)</label><input id="np-img" type="number" placeholder="e.g. 533"></div>'+
					'<div class="row2"><label style="display:flex;align-items:center;gap:8px;margin:0"><input type="checkbox" id="np-pub" style="width:auto"> Publish now (else save as draft)</label></div>'+
					'<div><button class="odn-a-btn" id="np-save">Create product</button></div>'+
					'<p class="odn-muted">Tip: upload photos in <a href="'+esc(B.media)+'" target="_blank" style="color:var(--a-amber)">Media</a> and paste the image ID here.</p></div></div>';
				var rows=list.length?list.map(function(p){
					return '<tr><td>'+(p.image?('<img src="'+esc(p.image)+'" style="width:38px;height:38px;object-fit:cover;border-radius:7px;vertical-align:middle">'):'')+' '+esc(p.name)+'</td>'+
						'<td>'+(p.price?('₹'+esc(p.price)):'—')+'</td>'+
						'<td>'+esc(p.categories.join(', ')||'—')+'</td>'+
						'<td><span class="odn-badge '+esc(p.status)+'">'+esc(p.status)+'</span></td>'+
						'<td><button class="odn-a-btn ghost sm" data-toggle="'+p.id+'" data-st="'+esc(p.status)+'">'+(p.status==='publish'?'Unpublish':'Publish')+'</button> '+
						'<button class="odn-a-btn danger sm" data-del="'+p.id+'">Delete</button></td></tr>';
				}).join(''):'<tr><td colspan="5"><div class="odn-empty">No products yet. Add your first above.</div></td></tr>';
				el.innerHTML=form+'<div class="odn-a-card"><h2>Products ('+list.length+')</h2><table class="odn-t"><thead><tr><th>Name</th><th>Price</th><th>Category</th><th>Status</th><th></th></tr></thead><tbody>'+rows+'</tbody></table></div>';
				$('#np-save').onclick=function(){
					var body={name:$('#np-name').value.trim(),price:$('#np-price').value,category:$('#np-cat').value.trim(),short:$('#np-short').value.trim(),publish:$('#np-pub').checked,image_id:$('#np-img').value||0};
					if(!body.name){flash('Please enter a name',false);return;}
					this.disabled=true;var btn=this;
					api('products',{method:'POST',body:JSON.stringify(body)}).then(function(){flash('Product created ✓',true);loadProducts();})
						.catch(function(e){flash(e,false);btn.disabled=false;});
				};
				el.querySelectorAll('[data-toggle]').forEach(function(b){b.onclick=function(){
					var ns=b.dataset.st==='publish'?'draft':'publish';
					api('products/'+b.dataset.toggle,{method:'POST',body:JSON.stringify({status:ns})}).then(function(){flash('Product '+ns,true);loadProducts();}).catch(function(e){flash(e,false);});
				};});
				el.querySelectorAll('[data-del]').forEach(function(b){b.onclick=function(){
					if(!confirm('Move this product to trash?'))return;
					api('products/'+b.dataset.del,{method:'DELETE'}).then(function(){flash('Product deleted',true);loadProducts();}).catch(function(e){flash(e,false);});
				};});
			}).catch(function(e){el.innerHTML='<div class="odn-empty">'+esc(e)+'</div>';});}

		loadDash();
	})();
	</script>
	<?php
}
