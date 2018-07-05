<div class="sidebar app-aside" id="sidebar">
    <div class="sidebar-container perfect-scrollbar">
        <nav>
            <ul class="main-navigation-menu">






                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'dashboard') ? 'active open' : '' ?>">
                    <a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'dashboard')); ?>">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-home"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Dashboard </span>
                            </div>
                        </div>
                    </a>
                </li>       





                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'banners') ? 'active open' : '' ?>">
                    <a href="<?php echo $this->Html->url(array('plugin' => 'banner', 'controller' => 'banners', 'action' => 'index')); ?>">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Home Banners </span>
                            </div>
                        </div>
                    </a>

                </li>


                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'schedules') ? 'active open' : '' ?>">
                    <a href="<?php echo $this->Html->url(array('plugin' => 'schedule', 'controller' => 'schedules', 'action' => 'index')); ?>">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Schedules </span>
                            </div>
                        </div>
                    </a>

                </li>


                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'events') ? 'active open' : '' ?>">
                    <a href="<?php echo $this->Html->url(array('plugin' => 'event', 'controller' => 'events', 'action' => 'index')); ?>">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Events </span>
                            </div>
                        </div>
                    </a>

                </li>

                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'faqs') ? 'active open' : '' ?>">
                    <a href="<?php echo $this->Html->url(array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'index')); ?>">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">FAQ's </span>
                            </div>
                        </div>
                    </a>

                </li>




                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'courses') ? 'active open' : '' ?>">
                    <a href="<?php echo $this->Html->url(array('plugin' => 'course', 'controller' => 'courses', 'action' => 'index')); ?>">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Courses </span>
                            </div>
                        </div>
                    </a>

                </li>





                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'scores') ? 'active open' : '' ?>">
                    <a href="javascript:void(0)">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Student Scores <i class="icon-arrow"></i> </span>
                            </div>
                        </div>
                    </a>
                    <ul class="sub-menu">

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'score', 'controller' => 'scores', 'action' => 'index')); ?>">
                                <span class="title"> Student Scores</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'score', 'controller' => 'scores', 'action' => 'upload_csv')); ?>">
                                <span class="title"> Upload Scores CSV</span>
                            </a>
                        </li>


                    </ul>
                </li>



                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'admission_counselling_results') ? 'active open' : '' ?>">
                    <a href="javascript:void(0)">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Admission Counselling <i class="icon-arrow"></i> </span>
                            </div>
                        </div>
                    </a>
                    <ul class="sub-menu">

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'admission_counselling_result', 'controller' => 'admission_counselling_results', 'action' => 'index')); ?>">
                                <span class="title">Counselling Results</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'admission_counselling_result', 'controller' => 'admission_counselling_results', 'action' => 'upload_csv')); ?>">
                                <span class="title"> Upload Result CSV</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'admission_counselling_course', 'controller' => 'admission_counselling_courses', 'action' => 'index')); ?>">
                                <span class="title">Counselling Courses</span>
                            </a>
                        </li>


                    </ul>

                </li>


                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'careers') ? 'active open' : '' ?>">
                    <a href="javascript:void(0)">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Careers <i class="icon-arrow"></i> </span>
                            </div>
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'career', 'controller' => 'careers', 'action' => 'index')); ?>">
                                <span class="title">Careers</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'career_category', 'controller' => 'career_categories', 'action' => 'index')); ?>">
                                <span class="title">Career Categories</span>
                            </a>
                        </li>


                    </ul>

                </li>

                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'reviews') ? 'active open' : '' ?>">
                    <a href="javascript:void(0)">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Reviews <i class="icon-arrow"></i> </span>
                            </div>
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'review', 'controller' => 'reviews', 'action' => 'index')); ?>">
                                <span class="title">Reviews</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'video_review', 'controller' => 'video_reviews', 'action' => 'index')); ?>">
                                <span class="title">Videos</span>
                            </a>
                        </li>



                    </ul>

                </li>

                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'videos') ? 'active open' : '' ?>">
                    <a href="javascript:void(0)">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Videos <i class="icon-arrow"></i> </span>
                            </div>
                        </div>
                    </a>
                    <ul class="sub-menu">

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'video', 'controller' => 'videos', 'action' => 'index', "?" => array('video_category_id' => "3", 'title' => "Preparation Videos"))); ?>">
                                <span class="title"> Preparation Videos</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'video', 'controller' => 'videos', 'action' => 'index', "?" => array('video_category_id' => "1", 'title' => "Resource Centre Videos"))); ?>">
                                <span class="title"> Resource Centre Videos</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'video', 'controller' => 'videos', 'action' => 'index', "?" => array('video_category_id' => "2", 'title' => "Events Videos"))); ?>">
                                <span class="title"> Events Videos</span>
                            </a>
                        </li>



                    </ul>
                </li>










<!--                <li class="slide_class <?php //echo (isset($tab_open) && $tab_open == 'medias') ? 'active open' : ''            ?>">
                    <a href="<?php //echo $this->Html->url(array('plugin' => 'media', 'controller' => 'medias', 'action' => 'index'));            ?>">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Medias </span>
                            </div>
                        </div>
                    </a>

                </li>-->





                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'blogs') ? 'active open' : '' ?>">
                    <a href="javascript:void(0)">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Blogs <i class="icon-arrow"></i> </span>
                            </div>
                        </div>
                    </a>
                    <ul class="sub-menu">

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'blog', 'controller' => 'blogs', 'action' => 'index')); ?>">
                                <span class="title"> Blogs</span>
                            </a>
                        </li>


                    </ul>
                </li>



                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'seo_scripts') ? 'active open' : '' ?>">
                    <a href="javascript:void(0)">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">SEO <i class="icon-arrow"></i> </span>
                            </div>
                        </div>
                    </a>
                    <ul class="sub-menu">

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => 'seo_script', 'controller' => 'seo_scripts', 'action' => 'index')); ?>">
                                <span class="title"> SEO Scripts</span>
                            </a>
                        </li>



                    </ul>
                </li>


                <li class="slide_class <?php echo (isset($tab_open) && $tab_open == 'cms') ? 'active open' : '' ?>">
                    <a href="javascript:void(0)">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-settings"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title">Website Content <i class="icon-arrow"></i> </span>
                            </div>
                        </div>
                    </a>
                    <ul class="sub-menu">

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'pages', 'action' => 'index'));       ?>">
                                <span class="title"> Pages</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'introductions', 'action' => 'edit', 1)); ?>">
                                <span class="title">Jamboree Introduction</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => "associate", 'controller' => 'associates', 'action' => 'index')); ?>">
                                <span class="title">Our Associates</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => "home_statistic", 'controller' => 'home_statistics', 'action' => 'index')); ?>">
                                <span class="title">Home Statistics</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => "social", 'controller' => 'socials', 'action' => 'index')); ?>">
                                <span class="title">Socials</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'contacts', 'action' => 'edit', 1)); ?>">
                                <span class="title">Contact Information</span>
                            </a>
                        </li>


                    </ul>
                </li>


            </ul>
        </nav>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function () {
        $(".heading_left").on("dblclick", function () {
            $(this).removeClass('open');
            var idthis = $(this).attr("id");
            // alert(idthis);
            var href = $("." + idthis + "_1").attr('href');
            //alert(href);
            window.location = href;
        });
    });

</script>