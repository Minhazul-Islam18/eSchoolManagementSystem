 <header class="app-header">
     <div class="flex items-center px-6 gap-3">
         <!-- Brand Logo -->
         <a href="{{ route('app.dashboard') }}" class="logo-box">
             <img src="{{ '/storage/' . setting('logo') }}" class="h-[calc(100%-2vh)] md:h-[calc(100%-5vh)]" alt="logo"
                 loading="lazy" />
         </a>

         <!-- Sidenav Menu Toggle Button -->
         <button id="button-toggle-menu" class="nav-link p-2">
             <span class="sr-only">Menu Toggle Button</span>
             <span class="flex items-center justify-center h-6 w-6">
                 <i data-lucide="menu" class="w-6 h-6 text-xl"></i>
             </span>
         </button>

         <!-- Page Title -->
         <div class="me-auto">
             <div class="md:flex hidden">
                 <h4 class="page-title text-lg">{{ $title ?? '' }}</h4>
             </div>
         </div>

         <div class="md:flex hidden items-center relative">
             <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                 <i class="mdi mdi-magnify text-base opacity-60 -z-10"></i>
             </div>
             <input type="search"
                 class="form-input pe-8 ps-4 rounded-full bg-gray-500/10 border-transparent focus:border-transparent placeholder:opacity-60"
                 placeholder="Search..." />
         </div>

         <!-- Light/Dark Toggle Button -->
         <div class="flex">
             <button id="light-dark-mode" type="button" class="nav-link p-2">
                 <span class="sr-only">Light/Dark Mode</span>
                 <span class="flex items-center justify-center h-6 w-6">
                     <i data-lucide="moon" class="block dark:hidden"></i>
                     <i data-lucide="sun" class="hidden dark:block"></i>
                 </span>
             </button>
         </div>

         <!-- Notification Bell Button -->
         <div class="relative md:flex hidden">
             <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button" class="nav-link p-2">
                 <span class="sr-only">View notifications</span>
                 <span class="flex items-center justify-center h-6 w-6">
                     <i data-lucide="bell"></i>
                     <span
                         class="absolute top-3 end-1.5 w-4 h-4 flex items-center justify-center rounded-full bg-danger text-white font-medium text-[10px]">9</span>
                 </span>
             </button>
             <div
                 class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-80 z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg">
                 <div class="p-4">
                     <div class="flex items-center justify-between">
                         <h6 class="text-sm">Notification</h6>
                         <a href="javascript: void(0);" class="text-gray-500">
                             <small>Clear All</small>
                         </a>
                     </div>
                 </div>

                 <div class="p-4 h-80" data-simplebar>
                     <h5 class="text-xs text-gray-500 dark:text-gray-300 mb-2">
                         Today
                     </h5>

                     <a href="javascript:void(0);" class="block mb-4">
                         <div class="card-body">
                             <div class="flex items-center">
                                 <div class="flex-shrink-0">
                                     <div
                                         class="flex justify-center items-center h-9 w-9 rounded-full bg text-white bg-primary">
                                         <i class="mdi mdi-comment-account-outline text-lg"></i>
                                     </div>
                                 </div>
                                 <div class="flex-grow truncate ms-2">
                                     <h5 class="text-sm font-semibold mb-1">
                                         Datacorp
                                         <small class="font-normal text-gray-500 ms-1">1 min ago</small>
                                     </h5>
                                     <small class="noti-item-subtitle text-muted">Caleb Flakelar commented
                                         on Admin</small>
                                 </div>
                             </div>
                         </div>
                     </a>

                     <a href="javascript:void(0);" class="block mb-4">
                         <div class="card-body">
                             <div class="flex items-center">
                                 <div class="flex-shrink-0">
                                     <div
                                         class="flex justify-center items-center h-9 w-9 rounded-full bg-info text-white">
                                         <i class="mdi mdi-heart text-lg"></i>
                                     </div>
                                 </div>
                                 <div class="flex-grow truncate ms-2">
                                     <h5 class="text-sm font-semibold mb-1">
                                         Admin
                                         <small class="font-normal text-gray-500 ms-1">1 hr ago</small>
                                     </h5>
                                     <small class="noti-item-subtitle text-muted">New user
                                         registered</small>
                                 </div>
                             </div>
                         </div>
                     </a>

                     <a href="javascript:void(0);" class="block mb-4">
                         <div class="card-body">
                             <div class="flex items-center">
                                 <div class="flex-shrink-0">
                                     <img src="{{ asset('backend/assets/images/users/avatar-2.jpg') }}"
                                         class="rounded-full h-9 w-9" alt="" />
                                 </div>
                                 <div class="flex-grow truncate ms-2">
                                     <h5 class="text-sm font-semibold mb-1">
                                         Cristina Pride
                                         <small class="font-normal text-gray-500 ms-1">1 day ago</small>
                                     </h5>
                                     <small class="noti-item-subtitle text-muted">Hi, How are you? What
                                         about our next meeting</small>
                                 </div>
                             </div>
                         </div>
                     </a>

                     <h5 class="text-xs text-gray-500 mb-2">Yesterday</h5>

                     <a href="javascript:void(0);" class="block mb-4">
                         <div class="card-body">
                             <div class="flex items-center">
                                 <div class="flex-shrink-0">
                                     <div
                                         class="flex justify-center items-center h-9 w-9 rounded-full bg-primary text-white">
                                         <i class="mdi mdi-account-plus text-lg"></i>
                                     </div>
                                 </div>
                                 <div class="flex-grow truncate ms-2">
                                     <h5 class="text-sm font-semibold mb-1">Datacorp</h5>
                                     <small class="noti-item-subtitle text-muted">Caleb Flakelar commented
                                         on Admin</small>
                                 </div>
                             </div>
                         </div>
                     </a>

                     <a href="javascript:void(0);" class="block">
                         <div class="card-body">
                             <div class="flex items-center">
                                 <div class="flex-shrink-0">
                                     <img src="{{ asset('backend/assets/images/users/avatar-4.jpg') }}"
                                         class="rounded-full h-9 w-9" alt="" />
                                 </div>
                                 <div class="flex-grow truncate ms-2">
                                     <h5 class="text-sm font-semibold mb-1">
                                         Karen Robinson
                                     </h5>
                                     <small class="noti-item-subtitle text-muted">Wow ! this admin looks
                                         good and awesome
                                         design</small>
                                 </div>
                             </div>
                         </div>
                     </a>
                 </div>

                 <a href="javascript:void(0);"
                     class="p-2 border-t border-dashed border-gray-200 dark:border-gray-700 block text-center text-primary underline font-semibold">
                     View All
                 </a>
             </div>
         </div>

         <!-- Profile Dropdown Button -->
         <div class="relative">
             @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                 <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button"
                     class="gap-x-2 nav-link flex items-center">
                     <img class="h-10 w-10 rounded-full object-cover"
                         src="{{ Auth::user()->profile_photo_path ?? Auth::user()->profile_photo_url }}"
                         alt="{{ Auth::user()->name }}" />
                     <div class="md:flex flex-col hidden">
                         <div class="font-medium text-base text-left text-gray-800 dark:text-gray-200">
                             {{ Auth::user()->name }}</div>
                         <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                     </div>
                     <i class="mdi mdi-chevron-down"></i>
                 </button>
             @endif

             <div
                 class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-44 z-50 transition-[margin,opacity] duration-300 bg-white shadow-lg border rounded py-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                 <h6 class="py-2 px-5">Welcome !</h6>
                 <div class=" md:hidden flex flex-col gap-2">
                     <div class=" px-5 font-medium text-sm text-left text-gray-800 dark:text-gray-200">
                         {{ Auth::user()->name }}</div>
                     <div class=" px-5 text-sm text-gray-500">{{ Auth::user()->email }}</div>
                 </div>
                 <a class="flex items-center py-2 px-5 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                     href="{{ route('profile.show') }}">
                     <i data-lucide="user" class="w-4 h-4 me-2"></i>
                     <span>My Account</span>
                 </a>
                 <hr class="my-2 -mx-2 border-gray-200 dark:border-gray-700" />
                 <form method="POST" action="{{ route('logout') }}" x-data>
                     @csrf
                     <button type="submit"
                         class="flex items-center py-2 px-5 text-sm w-full text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                         href="{{ route('logout') }}">
                         <i data-lucide="log-out" class="w-4 h-4 me-2"></i>
                         <span>Logout</span>
                     </button>
                 </form>
             </div>
         </div>
         <!-- Customization Button -->
         <div class="flex">
             <button type="button" class="nav-link p-2" data-fc-type="offcanvas"
                 data-fc-target="theme-customization" data-fc-scroll="true">
                 <span class="sr-only">Customization Button</span>
                 <span class="flex items-center justify-center h-6 w-6">
                     <i data-lucide="settings"></i>
                 </span>
             </button>
         </div>
     </div>
 </header>
