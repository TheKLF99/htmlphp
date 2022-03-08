# htmlphp
PHP class for producing HTML code.

I created this html.php for a Joomla site I was creating.  If included it creates a class called html with a few html functions...

Function list

tag ( $tag, $attr, $content, $close = true, $inline = false )

Tag returns a html tag and accepts the following parameters

tag - type of tag to return in a string (i.e. img/p/a/div etc)
attr - can either be a string or an array - a string will just be inserted into the tag as is in the tag attributes where as an array will be turned into a string of name="value"
so array ( 'class' => 'col-12', 'id' => 'myid' ) would return <$tag class="col-12" id="myid"> 
content - a string of the content that you would like to put between the tag
close - should the tag be closed or not - defaults to true - true tag has </$tag> added to the end
inline - should the tag be closed within the opening tag - used for things like img tags where there is no corresponding </$tag> (close is ignored if this is true and tag
is always closed) - example - <img src="" />

nda_file ()

Nda_file was used for Joomla originally and it creates a "no direct access" file - just an entire html document with one line "No direct access" used mainly in folders where you
don't want users typing in the url of the folder to view its contents. The $nda variable in the function can be altered to whatever message you want to give out.

ctag ( $tag )

Ctag returns a closed tag of whatever $tag is set to e.g. </p> or </span>

tag - type of tag to return in a string (i.e. p/a/div)

cdiv ()

Cdiv is the same as ctag but it only returns a div close "</div>"

p ( $attr, $content, $close = true )

Similar to tag but always returns a paragraph tag <p $attr>$content</p> - see tag for parameters.

b ( $attr, $content, $close = true )

Similar to tag but returns a span with the class "font-weight-bold" - as long as at least Boostrap 4 is being used this will embolden the text

parameters are the same as for the tag and p functions - if the attr parameter array already contains class then "font-weight-bold" will be added to the class e.g.

b ( array ( 'class' => 'myclass', 'onclick' => 'myfunction();' ), 'My emboldend content' )

would return <span class="myclass font-weight-bold" onclick="myfunction()">My emboldend content</span>

img ( $img, $alt, $attr = array (), $lazy = true )

Img returns an img tag - the parameters are as follows -

$img - url to image file (http://mywebsite.com/myimg.jpg) as string
$alt - alternative text for screen
$attr - array of extra attributes to be added to img (please note unlike other functions this will not accept an attr as a string - it must be an array)
defaults to an empty array
$lazy - defaults to true - if true then loading="lazy" attribute will be added to the image - if you want to use lazy loading of images then you will need
the appropriate javascript add-on though - this just sets up the image so the add-on knows which images to lazy load

img ( 'sunflower.jpg', 'A beautiful sunflower', array ( 'onclick' => 'expand();', true ) would return
<img src="sunflower.jpg" alt="A beautiful sunflower" onclick="expand();" loading="lazy" />

baseurl ()
Gets the baseurl of the website (originally when it was in joomla I'd used url::base() but as I've put it up here I've added a function that gets the baseurl withut being
reliant on joomla functions.

picture ( $images, $alt, $attr = array (), $lazy = true, $root = 'images', $img_attr = array () )

Picture creates a html5 picture tag with the following paramaters.

images - an array of images - the array element name is used for the image type - webp is always placed at the top so webp images are loaded by default if the browser
supports them, and there must be an "orig" element in the array which is used for the original fallback image if the browser doesn't support the picture tag.

array ( 'orig' => 'sunflower.jpg', 'png' => 'sunflower.png', 'webp' => 'sunflower.webp' ) 

alt - alt text for the images for a screen reader
attr - array of attributes that will be applied to the picture tag
root - root path to the images - defaults to "images" so in the example above sunflower.png would be 'images/sunflower.png' but if I changed root to 'images/banners' it would
be 'images/banners/sunflower.png'
img_attr - is an array of attributes which will be added to the <img> tag within the picture tag.

div ( $attr, $content, $close = true )
div returns a div tag - parameters are the same as the tag function.
span ( $attr, $content, $close = true )
span same as div but returns the content in a span tag

print_r ( $val )
Similar to the print_r command but will echo the contents of $val to the screen between <pre></pre> tags (if you echo print_r normally to the screen in a web browser the browser puts it all together and can make it very unreadable, but when it's put between pre tags the browser keeps the newline (\n) and tabs (\t) intact making print_r much more readable on a web browser.  Paramaters
$val - value to display on screen.

col ( $attr, $content = '', $size = 12, $breakpoint = '', $close = true )
Creates a bootstrap 4 column $attr, $contetn and $close are all the same parameters as in the tag function.
$size - defaults to 12 this can be changed to decrease column size ( 12 = 1 column, 6 = 1/2 width, 4 = 1/3 width, 3 = 1/4 width)
$breakpoin - defaults to '' which applies to all breakpoints but other bootstrap breakpoints can be added here like sm, md, lg, xl which affect the column size based on
screen-width.
col ( array ( 'class' => 'col-9' ), 'My column', 6, 'md' ) ; would return
<div class="col-9 col-md-6">My column</div>
which if bootstrap 4 is loaded would show a column on screen which is 3/4 screen width but on a medium screen (768px) would go to 1/2 screen width.


private addClass ( $class, $attr )
This is used internally within the class.  It adds a class to the attributes array.  It is mainly used for functions like b, col or row when adding a class to an existing array of attributes.  Parameters
$class - class to add to attributes
$attr - array of attributes

row ( $attr, $content, $close = true )
Similar to div but it returns a div which contains the bootstrap row class.

private attr ( $attr )
This is used internally within the class - it takes an $attr array and returns it as $key="$value" if $attr is a string it leaves it alone and just returns the string.  It creates the attributes for the html tag. <p ONCLICK="DOTHIS()" CLASS="MYCLASS">my content</p> (the bit in capitals).

a ( $link, $attr, $content, $close = true, $home = false )
returns a href link.  $attr, $close and $content are the same as the other $attr and $content variables although $attr must be an array (attr strings will be replaced with an empty array).  Parameters
$link - the link you want the href to link to.
$home - defaults to false - if true then the baseurl is added to the link so something like "contact-us" link would become "http://mysite.com/contact-us" if home is true.

h ( $size = 1, $attr = array () , $content = '', $close = true )
returns a heading tag.  $attr, $content and $close all work the same way as the $tag parameters.  Other parameters
$size - defaults to 1 but change the number and you can get different h tags
h ( 2, array ( 'class' => 'myclass', 'id' => 'myid' ), 'My heading 2' ) would produce
<h2 class="myclass" id="myid">My Heading 2</h2>

icon ( $icon, $sronly, $hidden = 'false' )
Used to create an icon on screen like a font awesome icon. Parameters.
$icon - icon class to create e.g. "fa fa-envelope"
$sronly - screen reader text to insert e.g. "E-mail"
$hidden - defaults to a string of "false" - either string "false" or string "true" accepted - used for the "aria-hidden" attribute if the icon should be hidden from the accessibility API.
icon ( 'fa fa-envelope', 'Email', 'true' ) would return
<i class="fa fa-envelope" aria-hidden="true"><span class="sr-only">Email</span></i>
which as long as font-awesome is loaded would show an envelope icon on screen and a screen reader would read "Email".

ibutton ( $link, $lattr, $icon, $sronly $hidden = "false" ) 
This is like a combination of the a function and the icon function it can be used to produce a button with an icon on it - parameters

$link - url to the link you want to make
$lattr - same as $attr must be an array and will be applied to the link attributes
$icon - icon class to create e.g. "fa fa-envelope"
$sronly - screen reader text to insert (see icon function)
$hidden - defaults to "false" - either string "false" or string "true" accepted - used for the "aria-hidden" attribute (see icon function)
ibutton ( 'mailto:myemail@email.com', array ( 'class' => 'btn btn-primary' ), 'fa fa-envelope', 'E-mail', 'true' ) ; would return
<a href="mailto:myemail@email.com" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"><span class="sr-only">E-mail</span></i></a>
