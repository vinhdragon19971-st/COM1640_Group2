@extends('index')
@section('index_content')
    <!-- about section -->
    <section class="layout_padding section about_dottat">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 text_align_center">
                  <div class="full heading_s1" id="AboutGW">
                     <h2 id="AboutGW">About</h2>
                  </div>
                  <div class="full">
                     <p class="large">
                     The University of Greenwich is a public university located in London and Kent, United Kingdom. Previous names include Woolwich Polytechnic and Thames Polytechnic
                    </p>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="about_img margin_top_30  text_align_center">
                  <iframe width="860" height="415" src="https://www.youtube.com/embed/tpwc7Oe8fak" frameborder="15" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end about section -->

      <!-- section -->
      <section class="layout_padding section">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 text_align_center">
                  <div class="full heading_s1">
                     <h2>Our Majors</h2>
                  </div>
                  <div class="full">
                     <p class="large">
                        An academic major is the discipline to which a university student is formally committed. A student who successfully completes all the courses required for a major will be eligible to receive a university degree.
                    </p>
                  </div>
               </div>
            </div>
            <div class="row">

              <div class="col-md-4 text_align_center">
                 <div class="cours">
                   <img class="img-responsive" src="{{asset('public/frontend/images/cour1.png')}}" alt="#" />
                 </div>
                 <h3>Design</h3>
                 <p>Design is the creation of a drawing or convention to create a measurable object, system or human interaction. In different disciplines, the design is assigned different meanings</p>
              </div>  

              <div class="col-md-4 text_align_center">
                 <div class="cours">
                   <img class="img-responsive" src="{{asset('public/frontend/images/cour2.png')}}" alt="#" />
                 </div>
                 <h3>IT</h3>
                 <p>Information technology, or IT for short, is an engineering branch that uses computers and computer software to convert, store, protect, process, transmit, and collect information.</p>
              </div> 

              <div class="col-md-4 text_align_center">
                 <div class="cours">
                   <img class="img-responsive" src="{{asset('public/frontend/images/cour3.png')}}" alt="#" />
                 </div>
                 <h3>Business</h3>
                 <p>A business is defined as an organization or enterprising entity engaged in commercial, industrial, or professional activities. ... The term "business" also refers to the organized efforts and activities of individuals to produce and sell goods and services for profit</p>
              </div> 

            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="full center">
                      <a class="blue_bt" href="#">Read More</a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end section -->

      <!-- section -->
      <section class="layout_padding section">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12 text_align_center">
                  <div class="full heading_s1">
                     <h2>Our Coaching Time</h2>
                  </div>
               </div>
            </div>
            <div class="row">
              <div class="col-md-12 cours_timging_bg">
                 <div class="container">
                    <div class="time_table">
                          <ul><li>Monday</li><li>8 Am - 6 Pm</li></ul>
                          <ul><li>Tuesday</li><li>9 Am - 5 Pm</li></ul>
                          <ul><li>Wednesday</li><li>10 Am - 8 Pm</li></ul>
                          <ul><li>Thursday</li><li>8  Am - 6 Pm</li></ul>
                          <ul><li>Friday</li><li>6 Am - 4 Pm</li></ul>
                          <ul><li>Saturday</li><li>9 Am - 5 Pm</li></ul>
                          <ul><li>Sunday</li><li>Holiday</li></ul>
                       </div>
                 </div>        
              </div> 
            </div>
         </div>
      </section>
      <!-- end section -->

      <!-- section -->
      <section class="layout_padding section">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12 text_align_center">
                  <div class="full heading_s1">
                     <h2>Our Success Stories</h2>
                  </div>
                  <div class="full">
                     <p class="large">Elliott Connell, HR Adviser – Amazon UK
                        Elliott credits his tutors and the university's careers service with his success. During his studies, he took a supervisor's role at the Students' Union bar and started putting his Business Psychology degree into practice.

                        A placement with the Caribbean-based hospitality firm Sandals helped Elliott make the transition into the world of work. He spent four months in St Lucia and five months in Grenada. 

                        "I was working very closely alongside the regional human resources manager, so it was great for my development and understanding of the working world," he says.

                        In April 2016, Elliott joined Amazon as an HR assistant, relocating to Manchester to help launch its first fulfilment centre in the North West. He has since been promoted to HR adviser and is still based in Manchester
                    </p>
                  </div>
               </div>
               <div class="col-md-12 testimonial">
                  <div class="full text_align_center">
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/WGYNuz6vn0c" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                     <h3><span class="theme_color_text">Elliott Connell, HR Adviser – Amazon UK</span><br><small>Alumni</small></h3>
                  </div>
               </div>
            </div>
        </div>
      </section>
      <!-- end section -->

    
      <!-- section -->
      <section class="section blue_pattern_bg" style="background-color: #3b3bff;">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="full">
                     <h4>Subscribe Now to Our Newsletter !</h4>
                     <p>aYour mail will be sent to the Greenwich University customer care mailbox. We will respond to your email as soon as possible.</p>
                  </div>
               </div>
               <div class="col-md-6">
                 <div class="form_subribe">
                    <form>
                       <input type="email" name="email" placeholder="Enter Your Email" />
                       <button>Subscribe</button>
                    </form>
                 </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end section -->
@endsection