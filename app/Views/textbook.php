
<div class="container">
<div class="col mt-5 mb-5">
<h2 class="text-center mt-5 mb-5" name="course_name"><?php //echo $course_name?> Free resources - Textbook </h2>

<div class="bd-example-snippet bd-code-snippet"><div class="bd-example">
        <div class="row  row-cols-1 row-cols-1 g-4 ">
          
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Textbook - Scrollingdown</h5>
                <p class="card-text "></p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item" style="display: none"> auther</li>
                <li class="list-group-item">2023 </li>
                <p class="list-group-item">This book is mainly about blablabla, descriptions blablablablabla.</P>
              </ul>
            </div>
          </div> 

          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title text-center">Content</h5>
                <p class="card-text "></p>
              </div>

                <p class="list-group-item" id="bookContent" name="text">                 
                    
                <?php echo $text ?>

                </p>
            </div>
          </div> 



              </ul>
              </div>



        </div>
        </div>
      </div>
</div>
</div>

<script>


// Citing code 
// The code snippet (1. Get Scroll Position) below has been adapted from
// https://stackoverflow.com/questions/17642872/refresh-page-and-keep-scroll-position
// I have adjusted the event listener and function structure to fit my feature

    function fun_scroll(){        // 1. when scrolling event, save the scroll position to local storage
        localStorage.setItem("scrollPosition", window.pageYOffset);  // window.pageYOffset:the pixels that the document has been scrolled vertically
    }                                                                //localStorage.setItem(key,value) save to browser
    window.addEventListener("scroll", fun_scroll);  //when"scroll"event, run fun_scroll()

    // 2. when loading, set the scroll position
    function fun_load(){
        var scrollPosition = localStorage.getItem("scrollPosition");  //return the scrolled value
        if (scrollPosition !== null) {
            window.scrollTo(0, scrollPosition);  //window.scrollTo(horizontal,vertical)
        }
    }
    window.addEventListener("load", fun_load);  //when"load"event,run fun_load

// End code snippet (1. Get Scroll Position)

</script>