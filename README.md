Starter Pack "Red" for Commerce
----

Welcome to the first official Starter Pack (or theme) for [Commerce](https://modmore.com/commerce/). This starter pack, based on Bootstrap, is meant to be used as a foundation for a Commerce-powered shop.

The design is best summarised as simple and modern. You could even say it's a little bland - but that's only so you can make it your own and fit any type of branding without heaving to tear out all sorts of details that don't fit. That's why it's a _Starter Pack_, and not a full-fledged _Theme_. 

The starter pack includes a variety of elements and assets to deliver the following functionality:

- Homepage with a hero image, featured product listing, category listing, simple header
- Simple categories overview with:
    - Links to your other categories
    - Simple filtering powered by Tagger (single group)
    - Photos, price ranges, and per product, and short description per product
    - Pagination support (pdoPage)
- Two simple product pages (Product Matrix and Product List) with:
    - Dependent select boxes for the product variety selection based on the [Product Matrix](https://docs.modmore.com/en/Commerce/v1/Product_Catalog/Product_Matrix.html), with dynamic rendering of available stock and variety price
    - Select box and quantity selectors when using a Product List TV and template instead of the Product Matrix.
    - AJAX-enhanced add to cart button
    - CSS-only tabs for additional content, filled by TVs on a per-resource basis, to hold anything from reviews or ingredients to more specifications.
    - Automatic list of related products based on the resource tags using Tagger
    - Automatic list of related products based on resource information using getRelated. 
- Mini-cart in the header, showing individual items, shipping costs, and total. 
- Wide cart design including product images (if available) and simple instant (AJAX) changing of quantity and deleting items, including support for standard coupons, and a much more simplified totals section than the default Commerce theme. 
- Fully AJAX-enhanced checkout theme, including support for all standard Commerce checkout functionality (repeat visit address selection, on-site and redirect payment gateways, etc) 
- Signup page for account registration, including email activation with the Login package
- "My Account" section offering:
    - Login
    - Commerce order history
    - Basic profile editing

The starter pack uses as little JavaScript as possible, loading only a single vanillajs file to offer the AJAX enhancements for the dependent selects (product varieties), cart and checkout. 

The compiled CSS weighs in at about 850KB, largely because the entire Bootstrap framework is loaded for development convenience. This can be optimised by changing the imports in the Sass to only include what you need.

The markup has been kept as simple as possible as well, using primarily standard Bootstrap classes.  

## Customising

The starter pack is distributed in such a way that you can make changes that are preserved when upgrading to a newer version of the theme. To learn more about how to do that, and what considerations to keep in mind, please find the readme in assets/components/commercetheme_red/. 

## Preview

[A quick preview of the theme can be found here.](http://theme-red.modmore.modxcloud.com/) Please be aware that site is more of a playground than a proper demo site, so there's been very little work down in terms of proper content. 

## Credits

Theme based on [Bootstrap 4.3](https://getbootstrap.com/). 

Using a [gulp workflow for assets](https://gulpjs.com/), including autoprefixer, cssnano, gulp-postcss, gulp-sass and gulp-sourcemaps to compile and optimise the CSS.

Special thanks to [Menno Pietersen of Any Screen Size](https://anyscreensize.com/) for help with the design and implementation.