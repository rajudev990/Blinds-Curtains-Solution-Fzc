<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        @if(Auth::guard('admin')->user()->image !=null)
        <img src="{{ Storage::url(Auth::guard('admin')->user()->image) }}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        @else
        <img src="{{ asset('admin-assets/') }}/img/AdminLTELogo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        @endif
        <span class="brand-text font-weight-light">{{ Auth::guard('admin')->user()->name }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @canany(['Book access', 'Book create', 'Book edit', 'Book delete'])
                <!-- <li class="nav-item">
                    <a href="{{ route('admin.books.index') }}" class="nav-link {{ Route::is('admin.books.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>All Book</p>
                    </a>
                </li> -->
                <li class="nav-item {{ Route::is('admin.books.*') ||  Route::is('admin.book.discount-list') ||  Route::is('admin.order.payment-list') ||  Route::is('admin.order.production-list') ||  Route::is('admin.order.installation-list') ||  Route::is('admin.order.feedback-list') ||  Route::is('admin.order.complete-list') ||  Route::is('admin.order.cancel-list') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa-file-alt fas nav-icon"></i>
                        <p>
                            All Books
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.books.index') }}" class="nav-link {{ Route::is('admin.books.*') ? 'active' : '' }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Pending</p> <span class="badge badge-success right right">{{ \App\Models\Book::where('status','pending')->count() }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.book.discount-list') }}" class="nav-link {{ Route::is('admin.book.discount-list') ? 'active' : '' }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Discount</p> <span class="badge badge-success right right">{{ \App\Models\Order::where('status','discount')->count() }}</span>
                            </a> 
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.order.payment-list') }}" class="nav-link {{ Route::is('admin.order.payment-list') ? 'active' : '' }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Payment</p> <span class="badge badge-warning right right">{{ \App\Models\Order::where('status','payment')->count() }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.order.production-list') }}" class="nav-link {{ Route::is('admin.order.production-list') ? 'active' : '' }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Production</p> <span class="badge badge-warning right right">{{ \App\Models\Order::where('status','production')->count() }}</span>
                            </a>
                        </li>

                       

                        <li class="nav-item">
                            <a href="{{ route('admin.order.installation-list') }}" class="nav-link {{ Route::is('admin.order.installation-list') ? 'active' : '' }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Installation</p> <span class="badge badge-warning right right">{{ \App\Models\Order::where('status','installation')->count() }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.order.feedback-list') }}" class="nav-link {{ Route::is('admin.order.feedback-list') ? 'active' : '' }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Feedback</p> <span class="badge badge-warning right right">{{ \App\Models\Order::where('status','feedback')->count() }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.order.complete-list') }}" class="nav-link {{ Route::is('admin.order.complete-list') ? 'active' : '' }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Complted</p> <span class="badge badge-success right right">{{ \App\Models\Book::where('status','complete')->count() }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.order.cancel-list') }}" class="nav-link {{ Route::is('admin.order.cancel-list') ? 'active' : '' }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Trashed</p> <span class="badge badge-danger right right">{{ \App\Models\Book::where('status','cancel')->count() }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcanany
                
                @canany(['BookTime access', 'BookTime create', 'BookTime edit', 'BookTime delete'])
                <li class="nav-item">
                    <a href="{{ route('admin.book-times.index') }}" class="nav-link {{ Route::is('admin.book-times.index') ? 'active' : '' }}">
                        <i class="fa-clock fas nav-icon"></i>
                        <p>Book Times</p> <span class="badge badge-warning right right">{{ \App\Models\BookingTime::count() }}</span>
                    </a>
                </li>
                @endcanany

                @canany(['Contact access', 'Contact create', 'Contact edit', 'Contact delete'])
                <li class="nav-item">
                    <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ Route::is('admin.contacts.index') ? 'active' : '' }}">
                        <i class="fa fa-envelope nav-icon"></i>
                        <p>Contact Message</p> <span class="badge badge-warning right right">{{ \App\Models\ContactUs::where('seen','0')->count() }}</span>
                    </a>
                </li>
                @endcanany
                
                @canany(['Subscriber access', 'Subscriber create', 'Subscriber edit', 'Subscriber delete'])
                <li class="nav-item">
                    <a href="{{ route('admin.subscribers.index') }}" class="nav-link {{ Route::is('admin.subscribers.index') ? 'active' : '' }}">
                        <i class="fa fa-envelope-open-text nav-icon"></i>
                        <p>Subscriber</p> <span class="badge badge-warning right right">{{ \App\Models\Subscriber::where('status','1')->count() }}</span>
                    </a>
                </li>
                @endcanany

                @canany(['User access','Permission access','Role access'])
                <li class="nav-item {{ Route::is('admin.permissions.*') || Route::is('admin.roles.*') || Route::is('admin.users.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.permissions.*') || Route::is('admin.roles.*') || Route::is('admin.users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User Management
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @canany(['Permission access', 'Permission edit', 'Permission create', 'Permission delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ Route::is('admin.permissions.*') ? 'active' : '' }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endcanany

                        @canany(['Role access', 'Role edit', 'Role create', 'Role delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Route::is('admin.roles.*') ? 'active' : '' }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endcanany

                        @canany(['User access', 'User edit', 'User create', 'User delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ Route::is('admin.users.*') ? 'active' : '' }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Staff</p>
                            </a>
                        </li>
                        @endcanany

                    </ul>
                </li>
                @endcanany

                @canany(['Marketing access', 'Marketing create', 'Marketing edit', 'Marketing delete'])
                <li class="nav-item">
                    <a href="{{ route('admin.role.book.marketing-list') }}" class="nav-link {{ Route::is('admin.role.book.marketing-list') ? 'active' : '' }}">
                        <i class="fa-user-friends fas nav-icon"></i>
                        <p>Marketing List <span class="badge badge-warning right right">{{ \App\Models\Book::where('status','pending')->count() }}</span>
                        </p>
                    </a>
                </li>
                @endcanany

                @canany(['Installation access', 'Installation create', 'Installation edit', 'Installation delete'])
                <li class="nav-item">
                    <a href="{{ route('admin.role.order.installation-list') }}" class="nav-link {{ Route::is('admin.role.order.installation-list') ? 'active' : '' }}">
                        <i class="fa-users fas nav-icon"></i>
                        <p>Installation List <span class="badge badge-warning right right">{{ \App\Models\Order::where('status','installation')->count() }}</span>
                        </p>
                    </a>
    
                </li>
                @endcanany

                @canany(['Production access', 'Production create', 'Production edit', 'Production delete'])
                <li class="nav-item">
                    <a href="{{ route('admin.role.order.production-list') }}" class="nav-link {{ Route::is('admin.role.order.production-list') ? 'active' : '' }}">
                        <i class="fa-user-plus fas nav-icon"></i>
                        <p>Production List <span class="badge badge-warning right right">{{ \App\Models\Order::where('status','production')->count() }}</span>
                        </p>
                    </a>
                </li>
                @endcanany



                @canany(['Product access','Category access'])
                <li class="nav-item {{ Route::is('admin.product.*') || Route::is('admin.categories.*') || Route::is('admin.size.*') || Route::is('admin.coupon.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.product.*') || Route::is('admin.categories.*') || Route::is('admin.size.*') || Route::is('admin.coupon.*')  ? 'active' : '' }}">
                        <i class="fa-list-ul fas nav-icon"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @canany(['Product access', 'Product create', 'Product edit', 'Product delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link {{ Route::is('admin.product.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>All Products</p>
                            </a>
                        </li>
                        @endcanany

                        @canany(['Category access', 'Category create', 'Category edit', 'Category delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ Route::is('admin.categories.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        @endcanany


                        @canany(['Coupon access', 'Coupon create', 'Coupon edit', 'Coupon delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.coupon.index') }}" class="nav-link {{ Route::is('admin.coupon.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Coupon</p>
                            </a>
                        </li>
                        @endcanany
                        
                    </ul>
                </li>
                @endcanany
                
                @canany(['Catalouge access', 'Catalouge create', 'Catalouge edit', 'Catalouge delete'])
                <li class="nav-item {{ Route::is('admin.catalogues.*') || Route::is('admin.catalogue-books.*') || Route::is('admin.page-numbers.*')  ? 'menu-open' : '' }}">
                    
                    <a href="#" class="nav-link {{ Route::is('admin.catalogues.*') || Route::is('admin.catalogue-books.*') || Route::is('admin.page-numbers.*')  ? 'active' : '' }}">
                        <i class="fa-window-restore fas nav-icon"></i>
                        <p>
                            Catalogues
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.catalogues.index') }}" class="nav-link {{ Route::is('admin.catalogues.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Catalogues</p>
                            </a>
                        </li>
                        
                       
                        <li class="nav-item">
                            <a href="{{ route('admin.catalogue-books.index') }}" class="nav-link {{ Route::is('admin.catalogue-books.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Catalogue Books</p>
                            </a>
                        </li>
                        

                        @canany(['Opening access', 'Opening create', 'Opening edit', 'Opening delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.page-numbers.index') }}" class="nav-link {{ Route::is('admin.page-numbers.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Page Number</p>
                            </a>
                        </li>
                        @endcanany

                    </ul>
                </li>
                @endcanany
                
                
                @canany(['FullNess access','Polling access', 'Opening access', 'Location access', 'Linning access'])
                <li class="nav-item {{ Route::is('admin.fullness.*') || Route::is('admin.polling.*') || Route::is('admin.opening.*') || Route::is('admin.location.*') || Route::is('admin.linning.*')  ? 'menu-open' : '' }}">
                    
                    <a href="#" class="nav-link {{ Route::is('admin.fullness.*') || Route::is('admin.polling.*') || Route::is('admin.opening.*') || Route::is('admin.location.*') || Route::is('admin.linning.*')  ? 'active' : '' }}">
                        <i class="fa-cube fas nav-icon"></i>
                        <p>
                            Windows
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @canany(['FullNess access', 'FullNess create', 'FullNess edit', 'FullNess delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.fullness.index') }}" class="nav-link {{ Route::is('admin.fullness.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>FullNess</p>
                            </a>
                        </li>
                        @endcanany

                        @canany(['Polling access', 'Polling create', 'Polling edit', 'Polling delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.polling.index') }}" class="nav-link {{ Route::is('admin.polling.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Polling</p>
                            </a>
                        </li>
                        @endcanany


                        @canany(['Opening access', 'Opening create', 'Opening edit', 'Opening delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.opening.index') }}" class="nav-link {{ Route::is('admin.opening.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Opening</p>
                            </a>
                        </li>
                        @endcanany
                        
                        @canany(['Location access', 'Location create', 'Location edit', 'Location delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.location.index') }}" class="nav-link {{ Route::is('admin.location.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Location</p>
                            </a>
                        </li>
                        @endcanany
                        
                        @canany(['Linning access', 'Linning create', 'Linning edit', 'Linning delete'])
                        <li class="nav-item">
                            <a href="{{ route('admin.linning.index') }}" class="nav-link {{ Route::is('admin.linning.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Linning</p>
                            </a>
                        </li>
                        @endcanany

                    </ul>
                </li>
                @endcanany
                
                
                

                <!-- Report -->
                @canany(['Report access'])
                <li class="nav-item">
                    <a href="{{ route('admin.report') }}" class="nav-link {{ Route::is('admin.report') ? 'active' : '' }}">
                        <i class="fa-file-alt fas nav-icon"></i>
                        <p>Reports</p>
                    </a>
                </li>
                @endcanany


                <!-- Report -->
                @canany(['Report access'])
                <li class="nav-item">
                    <a href="{{ route('admin.statements.index') }}" class="nav-link {{ Route::is('admin.statements.*') ? 'active' : '' }}">
                        <i class="fa-print fas nav-icon"></i>
                        <p>All Invoices</p>
                    </a>
                </li>
                @endcanany
               
    

                @canany(['Website access'])
                <li class="nav-item {{ Route::is('admin.banner.*') || Route::is('admin.hero-section.*') || Route::is('admin.happy-client.*') || Route::is('admin.services.*') || Route::is('admin.estimate-list.*') || Route::is('admin.help.*') || Route::is('admin.help-title.*') || Route::is('admin.different-fabric.*') || Route::is('admin.why-kurtains.*') || Route::is('admin.choose-curtain.*') || Route::is('admin.our-blog.*') || Route::is('admin.pages.*') || Route::is('admin.our-team.*') || Route::is('admin.social_link.*') || Route::is('admin.project-videos.*') || Route::is('admin.project-hilights.*') || Route::is('admin.get-estimate-title.*') || Route::is('admin.aboutus.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.banner.*') || Route::is('admin.hero-section.*') || Route::is('admin.happy-client.*') || Route::is('admin.services.*') || Route::is('admin.estimate-list.*') || Route::is('admin.help.*') || Route::is('admin.help-title.*') || Route::is('admin.different-fabric.*') || Route::is('admin.why-kurtains.*') || Route::is('admin.choose-curtain.*') || Route::is('admin.our-blog.*') || Route::is('admin.pages.*') || Route::is('admin.our-team.*') || Route::is('admin.social_link.*') || Route::is('admin.project-videos.*') || Route::is('admin.project-hilights.*') || Route::is('admin.get-estimate-title.*') || Route::is('admin.aboutus.*')  ? 'active' : '' }}">
                        <i class="fa fa-globe nav-icon"></i>
                        <p>
                            Website
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.banner.index') }}" class="nav-link {{ Route::is('admin.banner.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Home Banner</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.hero-section.index') }}" class="nav-link {{ Route::is('admin.hero-section.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Hero Section</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.services.index') }}" class="nav-link {{ Route::is('admin.services.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Services</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.estimate-list.index') }}" class="nav-link {{ Route::is('admin.estimate-list.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Estimate Media</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.happy-client.index') }}" class="nav-link {{ Route::is('admin.happy-client.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Client</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('admin.help-title.index') }}" class="nav-link {{ Route::is('admin.help-title.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Help Title</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.help.index') }}" class="nav-link {{ Route::is('admin.help.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Help</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.get-estimate-title.index') }}" class="nav-link {{ Route::is('admin.get-estimate-title.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Estimate Title</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.why-kurtains.index') }}" class="nav-link {{ Route::is('admin.why-kurtains.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Why B & C</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.choose-curtain.index') }}" class="nav-link {{ Route::is('admin.choose-curtain.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Choose Curtain</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.curtains-styles.index') }}" class="nav-link {{ Route::is('admin.curtains-styles.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Curtains Styles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.different-fabric.index') }}" class="nav-link {{ Route::is('admin.different-fabric.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Different Fabrics</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.our-team.index') }}" class="nav-link {{ Route::is('admin.our-team.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Our Team</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pages.index') }}" class="nav-link {{ Route::is('admin.pages.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Pages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.aboutus.index') }}" class="nav-link {{ Route::is('admin.aboutus.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>About Us Pages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.social_link.index') }}" class="nav-link {{ Route::is('admin.social_link.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Social Link</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.project-hilights.index') }}" class="nav-link {{ Route::is('admin.project-hilights.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Project Highlights</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.project-videos.index') }}" class="nav-link {{ Route::is('admin.project-videos.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Project Video</p>
                            </a>
                        </li>

                    </ul>
                </li>
                @endcanany

                @canany(['Smart Curtains access'])
                <li class="nav-item {{ Route::is('admin.electric-curtains.*') || Route::is('admin.smart-curtains-media.*') || Route::is('admin.life-styles.*') || Route::is('admin.go-furthers.*') || Route::is('admin.life-style-title.*') || Route::is('admin.smart-curtains-pages.index')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.electric-curtains.*') || Route::is('admin.smart-curtains-media.*') || Route::is('admin.life-styles.*') || Route::is('admin.go-furthers.*') || Route::is('admin.life-style-title.*') || Route::is('admin.smart-curtains-pages.index')  ? 'active' : '' }}">
                        <i class="fa-cube fas nav-icon"></i>
                        <p>
                            Smart Curtains
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.smart-curtains-pages.index') }}" class="nav-link {{ Route::is('admin.smart-curtains-pages.index') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Smart Curtains</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.electric-curtains.index') }}" class="nav-link {{ Route::is('admin.electric-curtains.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Electric Curtains</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.smart-curtains-media.index') }}" class="nav-link {{ Route::is('admin.smart-curtains-media.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Smart Curtains Media</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.life-style-title.index') }}" class="nav-link {{ Route::is('admin.life-style-title.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Life Styles Title</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.life-styles.index') }}" class="nav-link {{ Route::is('admin.life-styles.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Life Styles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.go-furthers.index') }}" class="nav-link {{ Route::is('admin.go-furthers.*') ? 'active' : ''  }}">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Go Further</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcanany

                @canany(['Setting access', 'Setting create', 'Setting edit', 'Setting delete'])
                <li class="nav-item">
                    <a href="{{ route('admin.setting.index') }}" class="nav-link {{ Route::is('admin.setting.index') ? 'active' : '' }}">
                        <i class="fa fa-globe nav-icon"></i>
                        <p>Website Settings</p>
                    </a>
                </li>
                @endcanany

                @canany(['Section Title access'])
                <li class="nav-item">
                    <a href="{{ route('admin.section-title.index') }}" class="nav-link {{ Route::is('admin.section-title.index') ? 'active' : '' }}">
                        <i class="fa fa-cog nav-icon"></i>
                        <p>Section Title Settings</p>
                    </a>
                </li>
                @endcanany

                @canany(['Cache access'])
                <li class="nav-item">
                    <a href="{{ route('admin.cache') }}" class="nav-link {{ Route::is('admin.cache') ? 'active' : '' }}">
                        <i class="fa fa-redo nav-icon"></i>
                        <p>Cache Management</p>
                    </a>
                </li>
                @endcanany



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>