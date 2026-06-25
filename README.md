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

## Note
Once this plugin is active, you can remove the "Additional CSS" you pasted earlier —
this replaces it (and adds the JS effects the editor can't run).
