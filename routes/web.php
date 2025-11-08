<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\goods\ProductController;
use App\Http\Controllers\admin\categories\CategoryController;
use App\Http\Controllers\admin\statistic\StatisticController;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class, 'index'])->name('home');

//Для посетителей
Route::prefix('/visitor')->middleware('guest')->group(function () {
   Route::get('/product/{id}', [HomeController::class, 'show'])->name('guest.product.show');
   Route::get('/categories', [HomeController::class, 'categorieslist'])->name('categories.show');
   Route::get('/categories/{category}', [HomeController::class, 'category'])->name('category.show');
   Route::get('/basket/show', [OrderController::class, 'show'])->name('guest.basket.show');
   Route::post('/basket/add', [OrderController::class, 'add'])->name('guest.basket.add');
   Route::post('/basket/update/{quantity}', [OrderController::class, 'updateQuantity'])->name('guest.basket.update.quantity');
   Route::get('/basket/order', [OrderController::class, 'order'])->name('guest.basket.order');
   Route::delete('/basket/remove/{productId}', [OrderController::class, 'removeFromBasket'])->name('guest.basket.remove');
});


//Для авторизированых пользо
Route::middleware('auth')->group(function () {
   //Все что происходит у зарегистрированых пользователей
   Route::get('/home', [HomeController::class, 'index'])->name('auth.home');
   Route::post('/product/{product}/like', [UserController::class, 'like'])->name('product.like');

   //Категории и просмотр товара
   Route::get('/categories/', [HomeController::class, 'categorieslist'])->name('auth.categories');
   Route::get('/categories/{category}', [HomeController::class, 'category'])->name('auth.product.categories');
   Route::get('products/{product}', [HomeController::class, 'show'])->name('auth.product.show');


   //Всё остальное для профиля
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   //User
   Route::prefix('user')->middleware('checkUser')->group(function () {
      Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.client');

      //Карзина
      Route::get('/basket/', [UserController::class, 'basket'])->name('user.basket');
      Route::post('/basket/', [UserController::class, 'add'])->name('user.add.basket');
      Route::get('/basket/{product}', [UserController::class, 'basketProduct'])->name('user.basket.product');
      Route::delete('/basket/{product}', [UserController::class, 'productDelete'])->name('user.basket.product.delete');
      //Товары которые понравились
      Route::get('/liked', [UserController::class, 'liked'])->name('user.liked');

      //Заказ и статус заказов
      Route::get('/basket/show', [OrderController::class, 'show'])->name('user.basket.show');
      Route::post('/basket/add', [OrderController::class, 'add'])->name('user.basket.add');
      Route::post('/basket/update/{quantity}', [OrderController::class, 'updateQuantity'])->name('user.basket.update.quantity');

      Route::post('/basket/order', [OrderController::class, 'order'])->name('user.basket.order');
      Route::delete('/basket/remove/{productId}', [OrderController::class, 'removeFromBasket'])->name('user.basket.remove');
   });


   //Admin
   Route::prefix('admin')->middleware('checkAdmin')->group(function () {
      Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.admin');
      //Goods
      Route::get('/goods/list', [ProductController::class, 'goods'])->name('admin.goods.list');
      Route::get('/goods/add', [ProductController::class, 'addForm'])->name('admin.product.addForm');
      Route::post('/goods/add/', [ProductController::class, 'add'])->name('admin.product.add');
      Route::get('/goods/{product}', [ProductController::class, 'formUpdate'])->name('admin.goods.update.form');
      Route::put('/goods/{product}', [ProductController::class, 'update'])->name('admin.goods.update');
      Route::get('/goods/{product}/delete', [ProductController::class, 'productDelete'])->name('admin.delete.product');


      //Categories
      Route::get('/catigory/add', [CategoryController::class, 'addForm'])->name('category.add.form');
      Route::post('/catigory/add', [CategoryController::class, 'add'])->name('admin.add.category');
      Route::delete('/category/deleted/{category}', [CategoryController::class, 'delete'])->name('admin.category.delete');
      Route::get('/catigories/update/{category}', [CategoryController::class, 'formUpdate'])->name('admin.catigory.formUpdate');
      Route::put('/categories/', [CategoryController::class, 'update'])->name('admin.category.update');


      //Orders
      Route::get('/orders/all/{status?}', [AdminController::class, 'orders'])->name('admin.orders.list');
      Route::get('/orders/{product_id}', [AdminController::class, 'show'])->name('admin.product.show');
      Route::put('/orders/update/{product_id}', [AdminController::class, 'UpdateOrderStatus'])->name('admin.order.update');

      //Statistics
      Route::get('/statistics/show', [StatisticController::class, 'statistics'])->name('admin.statistics.show');
   });
});

Route::fallback(function () {
   return view('errors.404');
})->name('fallback');
