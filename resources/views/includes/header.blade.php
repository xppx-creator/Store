@guest
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <x-container>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="text-start adaptive">
         <a href="{{ route('login') }}" type="button" class=" btn btn-outline-light">Войти</a>
         <a href="{{ route('register') }}" type="button" class="btn btn-warning">Зарегистрироваться</a>
      </div>

      <div class="collapse navbar-collapse" id="navbarNav">
         <br>
         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item display-flex justify-items-center p-2">
               <a href="{{ route('home') }}" class="nav-link menu-link-position {{ Route::is('home') ? 'text-white' : 'text-secondary' }}">
                  <x-icons.house/>
                  <span>Главная страница</span>
               </a>
            </li>
            <li class="nav-item display-flex justify-items-center p-2 category-text">
               <a href="{{ route('categories.show') }}" class="nav-link menu-link-position {{ Route::is('categories.show') ? 'text-white' : 'text-secondary' }} ">
                  <x-icons.category/>
                  <span >Категории</span>
               </a>
            </li>
            <li class="nav-item display-flex justify-items-center p-2">
               <a href="{{ route('guest.basket.show') }}" class="nav-link menu-link-position {{ Route::is('guest.basket.show') ? 'text-white' : 'text-secondary' }} position-relative">
                  <x-icons.basket/>
                  <span>Корзина</span>
                  @if (!empty(session('basket')))
                     <span class="position-absolute badge" style="top:0; right:-15px; font-size:15px;">
                        @php
                           echo count(session('basket', []));
                        @endphp
                     </span>
                  @endif
               </a>
            </li>

         </ul>
         <div class="nav-item sign">
            <div class="text-start">
               <a href="{{ route('login') }}" type="button" class="btn btn-outline-light">Войти</a>
               <a href="{{ route('register') }}" type="button" class="btn btn-warning">Зарегистрироваться</a>
            </div>
         </div>
      </div>
   </x-container>
</nav>
@endguest 

@auth
   @if(auth()->user()->isAdmin())
   <nav x-data="{ open: false }" class="bg-white header-position border-b border-gray-100">
      <!-- Primary Navigation Menu -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
         <div class="flex justify-between h-16">
            <a href="{{ route('dashboard.admin') }}" class="adaptive-profile menu-link-position">
               <x-icons.profile />
               <span>Профиль</span>
            </a>
               <div class="flex">
                  <!-- Navigation Links -->
                  <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                     <x-nav-link class="menu-link-position" :href="route('auth.home')"  :active="request()->routeIs('auth.home')">
                        <x-icons.house/>
                        <span style="padding-left: 30px"> {{ __('Главная страница') }}</span>
                     </x-nav-link>

                     <x-nav-link :href="route('auth.categories')"  :active="request()->routeIs('auth.categories')"> 
                        <x-icons.collection/>
                        <span style="padding-left: 30px"> {{ __('Категории') }} </span>
                     </x-nav-link>

                     <x-nav-link :href="route('admin.goods.list')"   :active="request()->routeIs('admin.goods.list')">
                        <x-icons.boxes/>
                        <span style="padding-left: 30px">{{ __('Товары') }}</span>
                     </x-nav-link>

                     <x-nav-link class="menu-link-position" :href="route('admin.orders.list')" :active="request()->routeIs('admin.orders.list')">
                        <x-icons.delivery/>
                        <span>{{ __('Заказы') }}</span>
                     </x-nav-link>

                     <x-nav-link :href="route('admin.statistics.show')"   :active="request()->routeIs('admin.statistics.show')">
                        <x-icons.graphics/>
                        <span style="padding-left: 30px">{{ __('Статистика') }}</span>
                     </x-nav-link>
                  </div>
               </div>
            
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
               <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                     <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>
                     
                        <div class="ms-1">
                           <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                           </svg>
                        </div>
                        </button>
                  </x-slot>
               
                  <x-slot name="content">
                     <x-dropdown-link :href="route('dashboard.admin')" class="menu-link-position">
                        <x-icons.profile />
                        <span>{{ __('Профиль') }}</span>
                     </x-dropdown-link>
                     <x-dropdown-link :href="route('profile.edit')" class="menu-link-position">
                        <x-icons.gear/>
                        <span>{{ __('Настройки') }}</span>
                     </x-dropdown-link>

                     <!-- Выход -->
                     <form method="POST" action="{{ route('logout') }}" class="menu-link-position">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                 this.closest('form').submit();">
                           <x-icons.out/>
                           <span>{{ __('Выход') }}</span>
                        </x-dropdown-link>
                     </form>
                  </x-slot>
               </x-dropdown>
            </div>
         
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
               <button @click="open = ! open" class=" inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                  {{-- <icons.hamburger/> --}}
                  <svg class="h-10 w-10" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                     <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                     <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
               </button>
            </div>
         </div>
      </div>
   
      <!-- Адаптивная внрсия Menu-burger -->
      <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
         <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link class="menu-link-position" :href="route('auth.home')" :active="request()->routeIs('auth.home')"><x-icons.house/><span>{{ __('Главная страница') }}</span></x-responsive-nav-link>
            <x-responsive-nav-link class="menu-link-position" :href="route('admin.goods.list')" :active="request()->routeIs('admin.goods.list')"><x-icons.boxes/> <span>{{ __('Товары') }}</span></x-responsive-nav-link>
            <x-responsive-nav-link class="menu-link-position" :href="route('admin.orders.list')" :active="request()->routeIs('admin.orders.list')"><x-icons.delivery/> <span>{{ __('Заказы') }}</span></x-responsive-nav-link>
            <x-responsive-nav-link class="menu-link-position" :href="route('auth.categories')" :active="request()->routeIs('auth.categories')"><x-icons.collection/> <span>{{ __('Категории') }}</span></x-responsive-nav-link>
            <x-responsive-nav-link class="menu-link-position" :href="route('admin.statistics.show')" :active="request()->routeIs('admin.statistics.show')"><x-icons.graphics/> <span>{{ __('Статистика') }}</span></x-responsive-nav-link>
         </div>
      
      
         <!-- Выпадающие меню -->
         <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
               <x-dropdown-link :href="route('dashboard.admin')" class="menu-link-position"><x-icons.profile/><span>{{ __('Профиль') }}</span></x-dropdown-link>
               <x-dropdown-link :href="route('profile.edit')" class="menu-link-position"><x-icons.gear/><span>{{ __('Настройки') }}</span></x-dropdown-link>

               <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-responsive-nav-link :href="route('logout')"
                     onclick="event.preventDefault();
                     this.closest('form').submit();"
                     class="menu-link-position"
                     >
                     <x-icons.out/>
                     <span> {{ __('Выйти') }}</span>
                  </x-responsive-nav-link>
               </form>
            </div>
         </div>
      </div>
   </nav>
   @else
      <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
         <!-- Primary Navigation Menu -->
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-12">
                  <div class="flex">
                     <!-- Navigation Links -->
                     <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link class="menu-link-position" :href="route('auth.home')"  :active="request()->routeIs('auth.home')">
                           <x-icons.house/>
                           <span> {{ __('Главная страница') }}</span>
                        </x-nav-link>
                     
                        <x-nav-link class="menu-link-position" :href="route('auth.categories')"  :active="request()->routeIs('auth.categories')"> 
                           <x-icons.category/>
                           <span> {{ __('Категории') }} </span>
                        </x-nav-link>
                     
                        <x-nav-link class="menu-link-position" :href="route('user.basket')"   :active="request()->routeIs('user.basket')">
                           <x-icons.basket/>
                           <span class="relative">
                              {{ __('Корзина') }}
                              @if (!empty(session('basket')))
                                 <span class="absolute" style="top:-6px; right:30px; font-size:15px;">
                                    @php
                                       echo count(session('basket', []));
                                    @endphp
                                 </span>
                              @endif
                           </span>
                           
                        </x-nav-link>
                     
                     </div>
                  </div>
               
                  <!-- Settings Dropdown -->
                  <div class="hidden sm:flex sm:items-center">
                     <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                           <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                              <div>{{ Auth::user()->name }}</div>
                           
                              <div class="ms-1 relative">
                                 <x-icons.down-arrow />
                              </button>
                        </x-slot>
                     
                        <x-slot name="content">
                           <x-dropdown-link :href="route('dashboard.client')" class="menu-link-position">
                              <x-icons.profile />
                              <span>{{ __('Профиль') }}</span>
                           </x-dropdown-link>
                           <x-dropdown-link  :href="route('user.liked')" class="menu-link-position">
                              <x-icons.like/>
                              <span> {{ __('Желаемые') }}</span>
                           </x-dropdown-link>
                           <x-dropdown-link :href="route('profile.edit')" class="menu-link-position pb-3">
                              <x-icons.gear/>
                              <span>{{ __('Настройки') }}</span>
                           </x-dropdown-link>
                           <!-- Выход -->
                           <form method="POST" action="{{ route('logout') }}" class="menu-link-position">
                              @csrf
                              <x-dropdown-link :href="route('logout')"
                                       onclick="event.preventDefault();
                                       this.closest('form').submit();"
                                       class="border-t border-gray-300">
                                 <x-icons.out/>
                                 <span>{{ __('Выход') }}</span>
                              </x-dropdown-link>
                           </form>
                        </x-slot>
                     </x-dropdown>
                  </div>
               
                  <!-- Hamburger -->
                  <div class="-me-2 flex items-center sm:hidden">
                     <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-10 w-10" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                           <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                           <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                     </button>
                  </div>
            </div>
         </div>
      
         <!-- Адаптивная внрсия Menu-burger -->
         
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
               <div class="pt-2 pb-3 space-y-1">
                  <x-responsive-nav-link :href="route('auth.home')" :active="request()->routeIs('auth.home')">
                     {{ __('Главная страница') }}
                  </x-responsive-nav-link>
                  <x-responsive-nav-link :href="route('auth.categories')" :active="request()->routeIs('auth.categories')"> {{ __('Категории') }}</x-responsive-nav-link>
                  <x-responsive-nav-link :href="route('user.basket')" :active="request()->routeIs('user.basket')"> {{ __('Корзина') }}</x-responsive-nav-link>
                  <x-responsive-nav-link :href="route('user.liked')" :active="request()->routeIs('user.liked')"> {{ __('Желаемые') }}</x-responsive-nav-link>
               </div>
            
            
               <!-- Выпадающие меню -->
               <div class="pt-4 pb-1 border-t border-gray-200">
                  <div class="mt-3 space-y-1">
                     <x-dropdown-link :href="route('dashboard.client')" class="menu-link-position"><x-icons.profile/><span>{{ __('Профиль') }}</span></x-dropdown-link>
                     <x-dropdown-link :href="route('user.liked')" class="menu-link-position"><x-icons.like/><span>{{ __('Желаемые') }}</span></x-dropdown-link>
                     <x-dropdown-link :href="route('profile.edit')" class="menu-link-position"><x-icons.gear/><span>{{ __('Настройки') }}</span></x-dropdown-link>
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link 
                           :href="route('logout')"
                           onclick="event.preventDefault();
                           this.closest('form').submit();"
                           class="menu-link-position">
                           <x-icons.out/>
                           <span> {{ __('Выйти') }}</span>
                        </x-responsive-nav-link>
                     </form>
                  </div>
               </div>
            </div>
      </nav>
   @endif

@endauth