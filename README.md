# poep.gr
GREEK ORGANIZATION OF EDUCATIONAL PROGRAMS

ASTRA FOLDER

  Contains the theme files as they are built by theme creators

/////////////////////////////////////////////////////////////

ASTRA-CHILD FOLDER

  Contains all the added HTML, PHP, JS, and CSS code of the theme creators and us (the developing team)
  
/////////////////////////////////////////////////////////////

acf-json FOLDER

  declares the parametrs of ACF fields (advanced custom fields), that I created to use on the site

  In other words, it indicates template pieces, which were not in the first place in the already existing purchased. They help me sort the site image I see in figma into smaller sections. For example, if I see that there is a text of size 100px in repetition, an image to the right of it and for background in foul width a color, then I will create a field that will accept as parameters a text an image, and a color and will place them in the positions and in the sizes I have specified. Every time I want something similar on my site, I will call this template and pass it the desired text, image, and color.

/////////////////////////////////////////////////////////////

images FOLDER

  Inside, I have contained all the '"banner" icons that I used

/////////////////////////////////////////////////////////////

js FOLDER

  Contains all my JavaScript.
  On the 'slick.min.js' file exists the js of the 'Slick' framework slider that I use for my sliders.
  My custom js exist on the 'custom-js.js'

/////////////////////////////////////////////////////////////

style.css

  Inside, I have contained all my custom CSS of the site.

/////////////////////////////////////////////////////////////

header.php-footer.php

  Both were created with custom code.

/////////////////////////////////////////////////////////////

custom-shortcodes.php

  I have contained all the shortcodes-functions, like sliders and carousels, that I have used in my site.

/////////////////////////////////////////////////////////////

template-parts FOLDER

  It contains the PHP which is displayed on some pages and calls up different elements each time, depending on the user and what they have chosen.

  For example, if the user has purchased some courses and selects the 'Elearning' page, then he will be able to see the list of his courses.

/////////////////////////////////////////////////////////////

oi-anthropoi-mas.php

  Has the PHP of the category that I have created inside the Posts in WordPress.
  
  That PHP refers to the button 'Οι Συνεργάτες μας' which exists on the home page and leads to the cooperators of that organization. The page of each cooperator has for template that file.

/////////////////////////////////////////////////////////////

single.php

  It is stated that if the category of the post is the cooperators, then call the file 'oi-anthropoi-mas.php'.

/////////////////////////////////////////////////////////////

single-product.php

  Is the structure behind every "single product-course" that has been created. The content is created with Gutenberg builder and ACF fields that I have create inside the file.

  First, when the user presses a course, the template calls the ID of that course.
  So:
    1. For the 'header of product' it displays the name, the small description, and the image of the product.
    2. Under, the left column (class 'left'), display the description of the product and the ACF fields (that have been created on 'group_63bd7a9500f92.json' in 'acf-json' FOLDER)
    3. The right column (class 'right') contains the product attributes
      a) How many lessons are contained
      b) How and where you can attend the course
      c) The locations
      d) The price
      e) The purchase options
      f) Button purchase
      g) Button add to cart
          For the button add to cart, with the combination of js, display a pop-up with a contact form, for the user to fill (class 'popup-form').
    4. After the columns it displays social icons to share that course (class 'product-social')
    5. In the and calls the footer, <?php get_footer(); ?>

/////////////////////////////////////////////////////////////

functions.php

  I have my functions.
    1. To create custom post-types to use on my WordPress site ('acf_add_options_page')
    2. To call them from the template-parts FOLDER and to display them in specific parts of my pages (//Woocommerce shop archive page)
    3. Function 'display_product_attributes' to display each product attributes in the right column of my product page
    4. Functions to add or convert the archive products pages

/////////////////////////////////////////////////////////////
