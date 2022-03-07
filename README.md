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
root - root path to the images - defaults to "images" so in the example above sunflower.png would be 'images\sunflower.png' but if I changed root to 'images\banners' it would
be 'images/banners/sunflower.png'



