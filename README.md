# ODN Prints — WordPress plugin

Applies the ODN Prints storefront look (dark glass + amber) and interactive
effects to odnprint.com, on top of the active theme. No theme switching needed.

## Files (all in repo root)
- `odn-print-wordpress.php` — plugin main file (enqueues assets, registers shortcode)
- `odn-style.css` — brand CSS + effects (glow, tilt, black-to-colour, wiper)
- `odn-interactions.js` — cursor glow + tilt cards + before/after wiper
- `README.md`

## Deploy (WordPress.com Deployments)
1. Push these files to the repo root of **ODN-Print-Wordpress** (branch `main`).
2. odnprint.com → **Deployments** → destination `/wp-content/plugins/ODN-Print-Wordpress`.
3. Run the deployment.
4. **Plugins** screen → activate **ODN Prints**.

## Effects
- Cursor-follow amber glow (desktop).
- 3D tilt + glare on category tiles and product cards (desktop).
- Product images load greyscale → full colour on hover.
- Before/after wiper via shortcode:
  `[odn_wiper before="IMG_URL" after="IMG_URL" before_label="Your photo" after_label="The figurine"]`

## Full ODN Prints site (standalone app)
The plugin ships the complete original single-page ODN Prints site at
`templates/odn-app.php` (dark/light theme, cursor spotlight, before/after slider,
tilt cards, PDP, cart → WhatsApp checkout, order wizard, design gallery, and a
local "Studio admin" behind a passcode). It renders with its own `<html>`/CSS/JS —
no theme header or footer — so it looks identical to the standalone design.

### Publish it as a page
1. Push these files → run the WordPress.com Deployment → activate **ODN Prints**.
2. wp-admin → **Pages → Add New**. Title it (e.g. "Home").
3. Set the page **slug** to `odn-app` (or pick the **"ODN Prints — Full App"**
   template in the page's Template panel). Either one triggers the standalone render.
4. Publish, then **Settings → Reading → "A static page" → Homepage =** that page
   to make it the front page.

Notes:
- This is a front-end **demo/marketing** experience. Cart "checkout" opens WhatsApp
  (`+91 86074 50921`); prices live in the JS `DEFAULT_CATALOG`. It does **not** use
  WooCommerce/Cashfree yet — that's the separate store-integration track.
- The "Studio admin" (type `odnadmin`, passcode `odn`) saves to the visitor's own
  browser via localStorage only; it does not change the live site for anyone else.

## Note
Once this plugin is active, you can remove the "Additional CSS" you pasted earlier —
this replaces it (and adds the JS effects the editor can't run).
