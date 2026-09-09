# ODN Prints — Admin Dashboard Roadmap (ODN Studio)

The full operational spec for turning **ODN Studio** from a visual tracker into a
real store-control system. Captured 2026-09-09.

Architecture note: ODN Studio runs **inside the ODN Prints plugin**, using
WooCommerce's own PHP API behind `manage_woocommerce` + REST-nonce auth — **no
external API key in client code** (satisfies the security guardrail).

---

## Current status (v1 — shipped)

| Module | Status |
|---|---|
| Dashboard / stats (products, orders, open, revenue) | ✅ basic |
| Orders (list + live status update) | ✅ basic |
| Products (list, create real WooCommerce products, publish/unpublish, delete) | ✅ basic |

Everything below is the target build.

---

## Modules needed for a complete e-commerce admin

### Dashboard / Store Health
Sales, profit, orders, conversion, abandoned carts, refunds, low stock, failed
payments, pending production, pending shipments, site uptime, and critical alerts.

### Orders
Full order detail page, payment status, fulfillment status, production status,
shipping label/tracking, customer notes, internal notes, refund/cancel, invoice,
packing slip, and order timeline.

### Products
Categories, collections, tags, variants, sizes, colors, materials, SKU, cost
price, selling price, tax class, dimensions, weight, SEO fields, related
products, product status, image ordering, bulk edit, duplicate product, and
scheduled publishing.

### Custom Product Orders (key for 3D figurines)
Customer image uploads, design/reference files, approval status, revision count,
production stage, final preview approval, and downloadable source assets.

### Gallery Management
Categories, gallery ordering, featured images, before/after or customer work,
premium-style collections, visibility controls, and linking gallery entries to
specific products.

### Inventory
Stock per variant, reserved stock, damaged stock, reorder threshold, supplier,
stock history, stock adjustment, purchase cost, and inventory alerts.

### Customers / CRM
Customer profile, order history, lifetime value, uploaded files, addresses,
refunds, notes, tags, WhatsApp/email history, and customer segmentation.

### Payments
Payment gateway status, successful/failed/pending payments, COD, refunds,
settlements, transaction IDs, gateway fees, and reconciliation.

### Shipping
Courier integration, service type, package dimensions, tracking number, shipping
cost, pickup status, delivery status, NDR/RTO tracking, and shipping-zone rules.

### Taxes & Invoices
GST configuration, HSN/SAC, tax-inclusive/exclusive pricing, GST invoices,
invoice numbering, credit notes, and downloadable PDFs.

### Discounts
Coupons, percentage/fixed discounts, minimum cart value, usage limits,
customer-specific coupons, free shipping, bundles, and expiry dates.

### Abandoned Carts
Customer/cart details, recovery status, email/WhatsApp reminder, recovery
coupon, and recovered revenue.

### Reviews
Approve/reject reviews, ratings, customer photos, verified-purchase tag, reply
to review, and product-rating summaries.

### Content / CMS
Homepage banners, announcement bar, FAQs, policies, About page, contact details,
product-page sections, homepage featured products, and promotional blocks.

### SEO
Page title, meta description, slug, canonical URL, schema, redirects, sitemap
status, broken links, and social preview image.

### Navigation
Header menus, footer menus, category menus, mobile navigation, and
visibility/order controls.

### Media Library
Centralized image/file manager, folders, alt text, compression, replace image,
file usage, and unused-media cleanup.

### Analytics
Revenue, profit, COGS, product performance, category performance, customer
acquisition, returning customers, conversion funnel, traffic source, geographic
sales, refund rate, and marketing ROAS.

### Finance / Profit
Revenue, product cost, packaging cost, shipping cost, gateway fees, ad spend,
GST, refunds, net profit, and profit per order/product.

### Marketing
Email campaigns, WhatsApp campaigns, push notifications, audience segments,
coupons, referral program, loyalty points, and campaign attribution.

### Site Settings
Store details, currency, timezone, GST, checkout configuration, payment
gateways, shipping rules, email templates, WhatsApp settings, order numbering,
and maintenance mode.

### Admin Users
Owner, manager, order staff, production staff, marketing staff, accountant; each
with role-based permissions.

### Security
Admin login activity, 2FA, failed-login alerts, session control, audit log,
backup status, plugin/theme updates, malware/security status.

### Site Maintenance
Backups, database health, cache control, image optimization, scheduled tasks,
uptime monitoring, error logs, PHP/server status, storage usage, and
plugin/update management.

### Notifications / Action Center
"7 low-stock products," "3 failed payments," "12 orders awaiting production,"
"5 customer files need approval," "2 shipments delayed," etc.

---

## ODN Prints production workflow (custom-order board)

Treat custom figurine orders as a production pipeline, not normal retail:

```
New Order
  → Customer Images Received
  → Design Pending
  → Design Ready
  → Customer Approval
  → Revision Requested
  → Approved
  → 3D Model / Print Preparation
  → Printing
  → Finishing
  → QC
  → Packed
  → Shipped
  → Delivered
```

A production board over these stages is far more useful than a plain order list.

---

## Target sidebar structure

```
HOME        → Overview, Action Center
SALES       → Orders, Abandoned Carts, Refunds
CATALOG     → Products, Categories, Collections, Gallery, Reviews, Media
PRODUCTION  → Custom Orders, Design Approval, Production Board
INVENTORY   → Stock, Suppliers, Purchase Orders
CUSTOMERS   → Customers, Segments, Messages
MARKETING   → Campaigns, Coupons, Loyalty
FINANCE     → Transactions, Invoices, GST, Profit
SHIPPING    → Shipments, Tracking, RTO/NDR
ANALYTICS   → Sales, Products, Customers, Traffic
WEBSITE     → Pages, Navigation, SEO, Banners
SYSTEM      → Users, Integrations, Security, Backups, Logs, Settings
```

---

## Highest-priority next additions

These turn the dashboard from a visual tracker into a real store-control system:

1. **Custom Order Production Board** (the ODN-specific pipeline above)
2. **Payment / Shipping management**
3. **Categories & Collections**
4. **Reviews** (moderation + reply)
5. **Media Library** (per-product organization)
6. **GST / Invoices**
7. **Site Content / SEO**
8. **Admin Security / Backups**

---

## Build sequence (proposed)

1. Product variations (sizes) + categories/collections in the Products module
2. Custom Order Production Board (kanban over the workflow stages)
3. Reviews moderation module
4. Order detail page (notes, timeline, refund, invoice/packing slip)
5. Shipping + tracking
6. GST config + PDF invoices
7. Content/SEO + Media organization
8. Users/roles + Security/backup status + Action Center
