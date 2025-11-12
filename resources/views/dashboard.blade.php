@section('title', 'Профиль')

@extends('layouts.main')
@section('content')
   @if (auth()->user()->isAdmin())
      <div class="mb-6">
         <h2 class="text-4xl font-bold text-gray-800">Admin Dashboard</h2>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
         <!-- Карточка 1 -->
         <div class="bg-gradient-to-br from-blue-500 to-purple-600 shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <div class="p-8 bg-white bg-opacity-90 rounded-lg">
               <h3 class="text-2xl font-bold text-gray-900 mb-4">Сумма товаров проданная за неделю</h3>
               <div class="text-4xl font-semibold text-gray-800 mb-6 flex items-center">
                  <p class="sales-amount text-blue-700" data-amount="3949">3949</p><span class="text-lg text-gray-600">$</span>
               </div>
               <hr class="border-gray-300 mb-6">
               <div>
                  <canvas class="sales-chart w-full p-6"></canvas>
               </div>
            </div>
         </div>

         <!-- Карточка 2 -->
         <div class="bg-gradient-to-br from-green-500 to-teal-600 shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <div class="p-8 bg-white bg-opacity-90 rounded-lg">
               <h3 class="text-2xl font-bold text-gray-900 mb-4">Сумма товаров проданная за месяц</h3>
               <div class="text-4xl font-semibold text-gray-800 mb-6 flex items-center">
                  <p class="sales-amount text-green-700" data-amount="5000">5000</p><span class="text-lg text-gray-600">$</span>
               </div>
               <hr class="border-gray-300 mb-6">
               <div>
                  <canvas class="sales-chart w-full p-6"></canvas>
               </div>
            </div>
         </div>
      
         <!-- Карточка 3 -->
         <div class="bg-gradient-to-br from-yellow-500 to-orange-600 shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <div class="p-8 bg-white bg-opacity-90 rounded-lg">
               <h3 class="text-2xl font-bold text-gray-900 mb-4">Самые продаваемые товары:</h3>
               <div class="text-4xl font-semibold text-gray-800 mb-6 flex items-center">
                  <p class="sales-amount text-orange-700" data-amount="7500">7500</p><span class="text-lg text-gray-600">$</span>
               </div>
               <hr class="border-gray-300 mb-6">
               <div>
                  <canvas class="sales-chart w-full p-6"></canvas>
               </div>
            </div>
         </div>
      </div>


      <!-- Категории -->
      <div class="my-8">
         <h2 class="text-2xl font-bold text-gray-700">Все категории</h2>
         <p class="tags flex gap-2 flex-wrap">
            <!-- Далее передавать категории товаров -->
            @foreach ($categories as $item)
               <a href="{{ route('auth.product.categories', $item) }}">{{ $item }}</a>
            @endforeach
         </p>
      </div>


      <!-- Товары -->
      <div class="my-8">
         <h2 class="text-2xl font-bold text-gray-700 mb-4">Товары</h2>
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Карточка для добавления нового товара -->
            <a href="{{ route('admin.product.add') }}" class="max-w-sm bg-gray-100 shadow-lg rounded-lg overflow-hidden border-2 border-dashed border-gray-300 transform transition duration-300 hover:scale-105 hover:shadow-2xl h-60 flex flex-col items-center justify-center">
               <div class="p-6 text-center">
                  <span class="text-gray-900 text-5xl">+</span>
                  <p class="text-xs text-gray-500 mt-2">Добавить новый товар</p>
               </div>
            </a>


            @foreach ($products as $product)
               <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl group">
                  <div class="bg-gray-500 h-60 transition-transform duration-300 group-hover:scale-110"></div>
                  <div class="p-6">
                     <h2 class="text-xl font-bold text-gray-900 mb-2"><a href="{{ route('auth.product.show',$product->id) }}">{{ $product->title }}</a></h2>
                     <p class="text-2xl font-semibold text-gray-900 mb-4">{{ $product->price }}$</p>
                     <p class="tags space-x-2">
                        @foreach ($product->categories as $category)
                           <a class="inline-block bg-gray-200 rounded-full px-2 py-1 text-sm text-gray-700 hover:bg-gray-300" href="{{ route('auth.product.categories', $category->name) }}">{{ $category->name }}</a>
                        @endforeach
                     </p>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
      <a href="{{ route('admin.goods.list') }}" class="bg-blue-500 text-white font-semibold  py-4 px-8 rounded-lg hover:bg-blue-600 transition duration-200">Все товары</a>
      <br><br>

      <!-- Заказы -->
      <div class="my-8">
         <h2 class="text-2xl font-bold text-gray-700">Заказы</h2>
         <div class="overflow-x-auto my-6">
            <table class="min-w-full bg-white border border-gray-300 shadow-lg rounded-lg">
               <thead>
                  <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                     <th class="py-3 px-6 text-left">ID</th>
                     <th class="py-3 px-6 text-left">Имя</th>
                     <th class="py-3 px-6 text-left">Товар</th>
                     <th class="py-3 px-6 text-left">Цены</th>
                     <th class="py-3 px-6 text-left">Количество</th>
                     <th class="py-3 px-6 text-left">Номер телефона</th>
                     <th class="py-3 px-6 text-left">Город и адрес</th>
                     <th class="py-3 px-6 text-left">Действия</th>
                  </tr>
               </thead>
               <tbody class="text-gray-600 text-sm font-light">
                  @foreach ($orders as $order)
                     @foreach ($order->items as $item)
                        <form action="{{ route('admin.product.show', $item->order_id) }}" method="GET">
                           @csrf
                           <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300">
                              <td class="py-3 px-6">{{ $item->id }}</td>
                              <td class="py-3 px-6">{{ $order->full_name }}</td>
                              <td class="py-3 px-6">{{ $item->name }}</td> <!-- Добавляем вывод названия товара -->
                              <td class="py-3 px-6">{{ $item->price }}$</td>
                              <td class="py-3 px-6">{{ $item->quantity }}</td>
                              <td class="py-3 px-6">{{ $order->number }}</td>
                              <td class="py-3 px-6">{{ $order->city }} ({{ $order->region }})</td>
                              <td class="py-3 px-6">
                                 <button type="submit" class="bg-blue-500 text-white font-semibold py-1 px-3 rounded-lg hover:bg-blue-600 transition duration-200 flex items-center">
                                    Просмотреть
                                 </button>
                              </td>
                           </tr>
                        </form>
                     @endforeach
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
      <br>
      <a href="{{ route('admin.orders.list') }}" class="bg-blue-500 text-white font-semibold  py-4 px-8 rounded-lg hover:bg-blue-600 transition duration-200">Список заказов</a>

      @push('graphics')
         <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
         @vite(['resources/js/graphics.js'])
      @endpush   
   @else
      <h2 class="text-2xl font-semibold text-gray-700 mb-4">Профиль для пользователя</h2>

      <!-- Информация о профиле -->
      <section class="my-10">
         <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-10 p-4">
            <div class="w-full sm:w-auto flex justify-center">
               <img src="https://via.placeholder.com/40" alt="User Avatar" class="rounded-md w-40 h-40 sm:w-60 sm:h-60">
            </div>
            <div class="flex-1">
               @foreach ($user as $item)
                  <h2 class="text-lg font-semibold text-gray-800 mb-2">Имя пользователя: {{ $item->name }}</h2>
                  <h2 class="text-md font-medium text-gray-600 mb-2">ФИО: {{ $item->FIO }}</h2>
                  <p class="text-gray-500 mb-2">Номер телефона: {{ $item->number }}</p>
                  <p class="text-gray-500 mb-2">Город: {{ $item->city }}</p>
                  <p class="text-gray-500 mb-2">Область: {{ $item->region }}</p>
                  <p class="text-gray-500">Електронная почта: {{ $item->email }}</p>
               @endforeach
            </div>
            <div>
               ДМЬБЖДАЬЖМДЬАЖ
            </div>
         </div>
      </section>


      <!-- Избранные товары -->
      @if (count($likedProducts) > 0)
         <section class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Избранные товары</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
               @foreach ($likedProducts as $product)
                  <div class="bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105 mb-4">
                     <a href="{{ route('auth.product.show', $product->id) }}" class="block">
                        <img src="https://via.placeholder.com/150" alt="Product Image" class="w-full h-32 object-cover rounded-md mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 truncate-text">{{ $product->title }}</h3>
                     </a>
                     <div class="flex justify-between mt-4">
                        <form action="{{ route('product.like', $product->id) }}" method="POST">
                           @csrf
                           <button type="submit" class="text-red-500 hover:underline">Удалить</button>
                        </form>
                     </div>
                  </div>
               @endforeach
            </div>
            <br>
            <a href="{{ route('user.liked') }}" class="bg-blue-400 text-white px-4 py-2 rounded-md hover:bg-blue-500">Все Избранные</a>
         </section>
      @else
         <br>
         <p>- У вас нет понравившихся товаров.</p>
         <br>
      @endif
      <br>


      <!-- В корзине -->
      @if ($basketProduct)
         <section class="mb-10">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Товары которые сейчас лежать в корзине</h2>
            <table class="min-w-full bg-white border border-gray-200">
               <thead class="bg-gray-200">
                  <tr>
                     <th class="py-2 px-4 text-left text-gray-700 font-semibold">Название</th>
                     <th class="py-2 px-4 text-left text-gray-700 font-semibold">Цена</th>
                     <th class="py-2 px-4 text-left text-gray-700 font-semibold">Количество</th>
                     <th class="py-2 px-4 text-left text-gray-700 font-semibold">Детали</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($basketProduct as $item)
                     <tr class="border-t border-gray-200 hover:bg-gray-100">
                        <td class="py-2 px-4">{{ $item['name'] }}</td>
                        <td class="py-2 px-4">{{ $item['price'] }}$</td>
                        <td class="py-2 px-4">{{ $item['quantity'] }}</td>
                        <td class="py-2 px-4"><a href="{{ route('auth.product.show', $item['product_id']) }}" class="text-blue-500 hover:underline">Посмотреть</a></td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
            <br>
            <a href="{{ route('user.basket') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Все товары в корзине</a>
         </section>
      @else 
         <br>
            <p>- Вы пока-что ничего не заказывали</p>
         <br>
      @endif
   @endif
@endsection
