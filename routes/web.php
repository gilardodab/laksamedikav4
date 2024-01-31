<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceppnController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanBarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\DailyReportMarketingController;
use App\Http\Controllers\HemochromaController;
use App\Http\Controllers\HemoglobinYofalabController;
use App\Http\Controllers\InvoiceCustomerController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\ServiceKendaraanController;
use App\Http\Controllers\SponsorRequestController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BrochureController;
use App\Http\Controllers\PengirimanController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/invoicecs', [InvoiceCustomerController::class, 'show'])->name('invoicecustomer.create');
Route::post('/create-invoice', [InvoiceCustomerController::class, 'create']);

Route::get('/sponsor-request/create', [SponsorRequestController::class, 'create'])->name('sponsor-request.create');
Route::post('/sponsor-request', [SponsorRequestController::class, 'store']);
Route::get('/sponsor-request/process', [SponsorRequestController::class, 'process'])->name('sponsor-request.process');
Route::post('/sponsor-request/approve/{sponsorRequest}', [SponsorRequestController::class, 'approve'])->name('sponsor-request.approve');
Route::get('/sponsor-request/index', [SponsorRequestController::class, 'index'])->name('sponsor-request.index');
Route::get('/sponsor-request/edit/{sponsorRequest}', [SponsorRequestController::class, 'edit'])->name('sponsor-request.edit');
Route::put('/sponsor-request/update/{sponsorRequest}', [SponsorRequestController::class, 'update'])->name('sponsor-request.update');
Route::get('/sponsor-request/history/{id}', [SponsorRequestController::class, 'history'])->name('sponsor-request.history');
Route::get('/user/{id}/sponsor-request/history', [SponsorRequestController::class, 'history']);

Route::post('/save', [InvoiceCustomerController::class, 'save'])->name('save');

Route::get('/daftar-barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/edit-barang/{id}', [BarangController::class, 'edit'])->name('barang.edit');
Route::post('/update-barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::post('/masuk-barang', [BarangController::class, 'masukBarang']);
Route::post('/keluar-barang', [BarangController::class, 'keluarBarang']);
Route::delete('/hapus-barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/barang-printgudang', [BarangController::class, 'printlapbaranggudang']);



Route::get('/brochures', [BrochureController::class, 'index'])->name('brochures.index');
Route::get('/brosur-user', [BrochureController::class, 'allbrosur'])->name('brochures.allbrosur'); //utk menampilkan brosur pada user
Route::get('/brochures/create', [BrochureController::class, 'create'])->name('brochures.create');
Route::post('/brochures/store', [BrochureController::class, 'store'])->name('brochures.store');
Route::get('/brochures/edit/{id}', [BrochureController::class, 'edit'])->name('brochures.edit');
Route::put('/brochures/update/{id}', [BrochureController::class, 'update'])->name('brochures.update');
Route::delete('/brochures/destroy/{id}', [BrochureController::class, 'destroy'])->name('brochures.destroy');
Route::get('/brochures/download/{id}', [BrochureController::class, 'download'])->name('brochures.download');

Route::get('/menuinvoice', [InvoiceController::class, 'index'])->name('invoice.index');

Route::post('customer-order/{id}/payment', [InvoiceCustomerController::class, 'processPayment'])->name('invoicecustomer.payment');
Route::post('/save-invoice', [InvoiceCustomerController::class, 'save'])->name('save.invoice');
Route::get('customer-order/{id}/payment', [InvoiceCustomerController::class, 'showPaymentForm'])->name('invoice.payment');
Route::get('/photo/{id}', [InvoiceCustomerController::class, 'showPhoto'])->name('photo.show');

Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
Route::get('/slider/all', [SliderController::class, 'all'])->name('slider.all');
Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
Route::post('/slider', [SliderController::class, 'store'])->name('slider.store');
Route::get('/slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
Route::put('/slider/{id}', [SliderController::class, 'update'])->name('slider.update');
Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

Route::get('/pengiriman', [PengirimanController::class, 'index']);
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/notif', [HomeController::class, 'notif'])->name('notif');
Route::get('/notif', [HomeController::class, 'notif'])->name('notif');
Route::get('/notif/ppn', [HomeController::class, 'notifppn'])->name('notif.ppn');
Route::get('/notif/product', [HomeController::class, 'notifProduct'])->name('notif.product');
Route::get('/read/{id}', [HomeController::class, 'read'])->name('read');
Route::get('/readppn/{id}', [HomeController::class, 'readppn'])->name('readppn');
Route::get('/close/{id}', [HomeController::class, 'closenotif'])->name('close.notif');
Route::get('/closeppn/{id}', [HomeController::class, 'closenotifppn'])->name('close.notifppn');

Route::get('/user', [UserController::class, 'index']);
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
});



Route::group(['middleware' => ['auth', 'ceklevel:superadmin']], function () {
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/new', [ProductController::class, 'create']);
        Route::post('/', [ProductController::class, 'save']);
        Route::get('/detail/{id}', [ProductController::class, 'createDetail']);
        Route::post('/detail', [ProductController::class, 'detailProduct'])->name('detail');
        Route::get('/edit/detail/{id}', [ProductController::class, 'editDetail']);
        Route::post('/save/detail/customer', [ProductController::class, 'SaveDetailCustomer'])->name('save.detail.customer');
        Route::get('/lihat/detail/{id}', [ProductController::class, 'lihatDetail'])->name('lihat.detail');
        Route::put('/update/detail/{id}', [ProductController::class, 'updateDetail'])->name('update.detail');
        Route::get('/edit/detail/customer/{id}', [ProductController::class, 'editDetailCustomer']);
        Route::put('/update/detail/customer/{id}', [ProductController::class, 'updateCustomerDetail'])->name('update.customerdetail');
        Route::put('/stock/{id}', [ProductController::class, 'tambahStock'])->name('tambah.stock');
        Route::delete('detail/{id}', [ProductController::class, 'destroyDetail']);
        Route::delete('detail/customer/{id}', [ProductController::class, 'destroyDetailCustomer']);
        Route::get('/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
        Route::get('/cari/product', [ProductController::class, 'cari'])->name('product.cari');
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', [CustomerController::class, 'index']);
        Route::get('/new', [CustomerController::class, 'create']);
        Route::post('/', [CustomerController::class, 'save']);
        Route::get('/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('/{id}', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
        Route::get('/cari/customer', [CustomerController::class, 'cari'])->name('customer.cari');
    });

    Route::group(['prefix' => 'invoice'], function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/new', [InvoiceController::class, 'create'])->name('invoice.create');
        Route::post('/', [InvoiceController::class, 'save'])->name('invoice.store');
        Route::get('/{id}', [InvoiceController::class, 'edit'])->name('invoice.edit');
        Route::put('/{id}', [InvoiceController::class, 'update'])->name('invoice.update');
        Route::get('/{id}/status', [InvoiceController::class, 'status'])->name('invoice.status');
        Route::get('/invoice/trash', [InvoiceController::class, 'trash'])->name('invoice.trash');
        Route::get('/invoice/all', [InvoiceController::class, 'allinvoice'])->name('invoice.allinvoice');
        Route::delete('/{id}', [InvoiceController::class, 'deleteProduct'])->name('invoice.delete_product');
        Route::delete('/{id}/delete', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
        Route::get('/{id}/print', [InvoiceController::class, 'generateInvoice'])->name('invoice.print');
        Route::get('/{id}/print2', [InvoiceController::class, 'generateInvoice2'])->name('invoice.print2');
        Route::get('/cari/create', [InvoiceController::class, 'cari'])->name('create.cari');
        Route::get('/pengiriman/{id}', [InvoiceController::class, 'pengiriman'])->name('invoice.kirim');
        Route::put('/simpan/pengiriman/{id}', [InvoiceController::class, 'savepengiriman'])->name('invoice.simpankirim');
        Route::delete('/{id}/delete/pengiriman', [InvoiceController::class, 'deletepengiriman'])->name('invoice.deletepengiriman');
       
    });
    Route::get('/add/nondanppn', [HomeController::class, 'invoicenondanppn']);
    Route::get('/menuinvoice', [HomeController::class, 'allinvoice']);
    Route::get('/menuorder', [HomeController::class, 'invoicenondanppnapp']);

    Route::group(['prefix' => 'invoiceppn'], function () {
        Route::get('/', [InvoiceppnController::class, 'index'])->name('invoiceppn.index');
        Route::get('/new', [InvoiceppnController::class, 'create'])->name('invoiceppn.create');
        Route::post('/', [InvoiceppnController::class, 'save'])->name('invoiceppn.store');
        Route::get('/{id}', [InvoiceppnController::class, 'edit'])->name('invoiceppn.edit');
        Route::put('/{id}', [InvoiceppnController::class, 'update'])->name('invoiceppn.update');
        Route::get('/{id}/status', [InvoiceppnController::class, 'status'])->name('invoiceppn.status');
        Route::get('/invoiceppn/trash', [InvoiceppnController::class, 'trash'])->name('invoiceppn.trash');
        Route::get('/invoiceppn/all', [InvoiceppnController::class, 'allinvoice'])->name('invoiceppn.allinvoice');
        Route::delete('/{id}', [InvoiceppnController::class, 'deleteProduct'])->name('invoiceppn.delete_product');
        Route::delete('/{id}/delete', [InvoiceppnController::class, 'destroy'])->name('invoiceppn.destroy');
        Route::get('/{id}/print', [InvoiceppnController::class, 'generateInvoice'])->name('invoiceppn.print');
        Route::get('/{id}/print2', [InvoiceppnController::class, 'generateInvoice2'])->name('invoiceppn.print2');
        Route::get('/cari/createppn', [InvoiceppnController::class, 'cari'])->name('createppn.cari');
        Route::get('/pengiriman/{id}', [InvoiceppnController::class, 'pengirimanppn'])->name('invoiceppn.pengirimanppn');
        Route::put('/simpan/pengiriman/{id}', [InvoiceppnController::class, 'savepengirimanppn'])->name('invoiceppn.simpanpengirimanppn');
        Route::delete('/{id}/delete/pengiriman', [InvoiceppnController::class, 'deletepengirimanppn'])->name('invoiceppn.deletepengirimanppn');
    });

    // Route::group(['prefix' => 'callplan'], function () {
    //     Route::get('/', [CallplanController::class, 'index']);
    //     Route::get('/all', [CallplanController::class, 'allcallplan']);
    //     Route::get('/detail/customer/{id}', 'CallplanController@createDetailCustomer')->name('callplan.DetailCustomer');
    //     Route::post('/', 'CallplanController@save');
    //     Route::delete('/detail/delete/{id}', 'CallplanController@destroy');
    //     Route::delete('/{id}', 'CallplanController@destroycustomer');
    //     Route::delete('/delete/{id}', 'CallplanController@destroycallplan');
    //     Route::get('/detail/{id}', 'CallplanController@createDetail')->name('callplan.create');
    //     Route::post('/detail/{id}', 'CallplanController@saveDetail');
    //     Route::post('/detail/customer/{id}', 'CallplanController@saveDetailCustomer');
    //     Route::get('/lihat/detail/{id}', 'CallplanController@lihatDetail')->name('callplan.detail');
    //     Route::get('/{id}/print', 'CallplanController@generateCallplan')->name('callplan.print');
    // });

    Route::get('/laporan-penjualan', [LaporanController::class, 'index']);
    Route::get('/cari', [LaporanController::class, 'cari']);
    Route::get('/carippn', [LaporanController::class, 'carippn']);
    Route::get('/laporan-barang', [LaporanBarangController::class, 'index']);
    Route::get('/barang-print', [LaporanBarangController::class, 'printlapbarang']);
  
    
    Route::group(['prefix' => 'penawaran'], function () {
        Route::get('/', [PenawaranController::class, 'index'])->name('penawaran.index');
        Route::get('/all', [PenawaranController::class, 'allpenawaran'])->name('penawaran.allpenawaran');
        Route::get('/new', [PenawaranController::class, 'create']); 
        Route::post('/', [PenawaranController::class, 'save']);
        Route::get('/detail/{id}', [PenawaranController::class, 'detail'])->name('detail.penawaran');
        Route::post('/save-kondisi', [PenawaranController::class, 'savekondisi']);
        Route::post('/save-harga', [PenawaranController::class, 'saveharga']);
        Route::get('/print/{id}', [PenawaranController::class, 'printpenawaran'])->name('print.penawaran');
        Route::delete('/delete/kondisi/{id}', [PenawaranController::class, 'destroyKondisi']);
        Route::delete('/delete/harga/{id}', [PenawaranController::class, 'destroyHarga']);
        Route::delete('/delete/{id}', [PenawaranController::class, 'destroy']);
        Route::get('/cari/penawaran', [PenawaranController::class, 'cari'])->name('cari.penawaran');
    });
    
    Route::group(['prefix' => 'daily-report-marketing'], function () {
        Route::get('/', [DailyReportMarketingController::class, 'index']);
        Route::get('/all', [DailyReportMarketingController::class, 'alldailyreportmkt']);
        Route::get('/new', [DailyReportMarketingController::class, 'create']);
        Route::post('/', [DailyReportMarketingController::class, 'save']);
        Route::get('/detail/{id}', [DailyReportMarketingController::class, 'detail'])->name('detail.dailyreportmkt');
        Route::post('/save-detail/{id}', [DailyReportMarketingController::class, 'savedetail']);
        Route::get('/lihat/{id}', [DailyReportMarketingController::class, 'lihatdetail'])->name('lihat.dailyreportmkt');
        Route::delete('/delete/detail/{id}', [DailyReportMarketingController::class, 'destroydetail']);
        Route::delete('/delete/{id}', [DailyReportMarketingController::class, 'destroy']);
        Route::get('/cari', [DailyReportMarketingController::class, 'cari'])->name('cari.dailyreportmkt');
        Route::get('/print/{id}', [DailyReportMarketingController::class, 'printdailyreportmkt'])->name('print.dailyreportmkt');
    });
    
    Route::group(['prefix' => 'hemoglobin-yofalab'], function () {
        Route::get('/', [HemoglobinYofalabController::class, 'index'])->name('hbyofalab.index');
        Route::get('/new', [HemoglobinYofalabController::class, 'create']); 
        Route::post('/', [HemoglobinYofalabController::class, 'save']);
        Route::get('/detail/{id}', [HemoglobinYofalabController::class, 'detail'])->name('detail.hbyofalab');
        Route::post('/save-detail', [HemoglobinYofalabController::class, 'savedetail']);
        Route::get('/lihat/{id}', [HemoglobinYofalabController::class, 'lihatdetail'])->name('lihat.hbyofalab');
        Route::delete('/delete/detail/{id}', [HemoglobinYofalabController::class, 'destroydetail']);
        Route::delete('/delete/{id}', [HemoglobinYofalabController::class, 'destroy']);
        Route::get('/print', [HemoglobinYofalabController::class, 'printhbyofalab'])->name('print.hbyofalab');
        Route::get('/cari', [HemoglobinYofalabController::class, 'cari'])->name('cari.hbyofalab');
        Route::get('/signaturepad', [HemoglobinYofalabController::class, 'signaturepad']);
        Route::post('/signaturepad/upload', [HemoglobinYofalabController::class, 'upload'])->name('signaturepad.upload');
    });
    
    Route::group(['prefix' => 'hemochroma'], function () {
        Route::get('/', [HemochromaController::class, 'index'])->name('hemocrhoma.index');
        Route::get('/new', [HemochromaController::class, 'create']); 
        Route::post('/', [HemochromaController::class, 'save']);
        Route::get('/detail/{id}', [HemochromaController::class, 'detail'])->name('detail.hemochroma');
        Route::post('/save-detail', [HemochromaController::class, 'savedetail']);
        Route::get('/lihat/{id}', [HemochromaController::class, 'lihatdetail'])->name('lihat.hemochroma');
        Route::delete('/delete/detail/{id}', [HemochromaController::class, 'destroydetail']);
        Route::delete('/delete/{id}', [HemochromaController::class, 'destroy']);
        Route::get('/print', [HemochromaController::class, 'printhemochroma'])->name('print.hemochroma');
        Route::get('/cari', [HemochromaController::class, 'cari'])->name('cari.hemochroma');
    });

    Route::group(['prefix' => 'customer-order'], function () {
        Route::get('/', [InvoiceCustomerController::class, 'index']);
        Route::get('/allinvoice/customer', [InvoiceCustomerController::class, 'allinvoicecustomer'])->name('invoicecustomer.allinvoice');
        Route::post('/', [InvoiceCustomerController::class, 'save'])->name('invoicecustomer.store');
        Route::get('/{id}', [InvoiceCustomerController::class, 'edit'])->name('invoicecustomer.edit');
        Route::put('/{id}', [InvoiceCustomerController::class, 'update'])->name('invoicecustomer.update');
        Route::delete('/{id}', [InvoiceCustomerController::class, 'deleteProduct'])->name('invoicecustomer.delete_product');
        Route::delete('/{id}/delete', [InvoiceCustomerController::class, 'destroy'])->name('invoicecustomer.destroy');
        Route::get('/{id}/print', [InvoiceCustomerController::class, 'generateInvoice'])->name('invoicecustomer.print');
        Route::get('/{id}/printnonppn', [InvoiceCustomerController::class, 'generateInvoiceNonPPN'])->name('invoicecustomer.printnonppn');
        Route::put('/{id}/update-status', [InvoiceCustomerController::class, 'updateStatus'])->name('invoicecustomer.updateStatus');
    });
    Route::group(['prefix' => 'soal'], function () {
        Route::get('/', [SoalController::class, 'index']);
        Route::get('/hasiltest', [SoalController::class, 'hasiltest']);
        Route::get('/new', [SoalController::class, 'buat_soal']);
        Route::post('/', [SoalController::class, 'save']);
        Route::get('/isisoal/{id}', [SoalController::class, 'isi_soal'])->name('soal.isi_soal');
        Route::post('/savesoal', [SoalController::class, 'savesoal']);
        Route::delete('/delete/soal/{id}', [SoalController::class, 'destroysoal']);
        Route::delete('/delete/topik/{id}', [SoalController::class, 'destroy']);
        Route::get('/testsoal/{id}', [SoalController::class, 'testsoal']);
        Route::post('/savejawaban', [SoalController::class, 'savejawaban'])->name('save.jawaban');
        Route::get('/{id}/print', [SoalController::class, 'generateInvoice'])->name('soal.print');
    });
    
    Route::group(['prefix' => 'service-kendaraan'], function () {
        Route::get('/', [ServiceKendaraanController::class, 'index'])->name('service.kendaraan.index');
        Route::get('/new', [ServiceKendaraanController::class, 'create']);
        Route::post('/', [ServiceKendaraanController::class, 'save']);
        Route::get('/detail/{id}', [ServiceKendaraanController::class, 'detail'])->name('service_kendaraan.detail');
        Route::post('/savedetail', [ServiceKendaraanController::class, 'savedetail'])->name('service.save.detail');
        Route::delete('/delete/detail/{id}', [ServiceKendaraanController::class, 'destroydetail']);
        Route::delete('/delete/{id}', [ServiceKendaraanController::class, 'destroy']);
        Route::get('/{id}/print', [ServiceKendaraanController::class, 'print'])->name('service_kendaraan.print');
    });
    
});


Route::group(['middleware' => ['auth', 'ceklevel:superadmin,admin']], function () {
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/new', [ProductController::class, 'create']);
        Route::post('/', [ProductController::class, 'save']);
        Route::get('/detail/{id}', [ProductController::class, 'createDetail']);
        Route::post('/detail', [ProductController::class, 'detailProduct'])->name('detail');
        Route::get('/edit/detail/{id}', [ProductController::class, 'editDetail']);
        Route::get('/lihat/detail/{id}', [ProductController::class, 'lihatDetail'])->name('lihat.detail');
        Route::put('/update/detail/{id}', [ProductController::class, 'updateDetail'])->name('update.detail');
        Route::put('/stock/{id}', [ProductController::class, 'tambahStock'])->name('tambah.stock');
        Route::delete('detail/{id}', [ProductController::class, 'destroyDetail']);
        Route::get('/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
        Route::get('/cari/product', [ProductController::class, 'cari'])->name('product.cari');
    });
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', [CustomerController::class, 'index']);
        Route::get('/new', [CustomerController::class, 'create']);
        Route::post('/', [CustomerController::class, 'save']);
        Route::get('/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('/{id}', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
        Route::get('/cari/customer', [CustomerController::class, 'cari'])->name('customer.cari');
    });
    Route::group(['prefix' => 'invoice'], function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/new', [InvoiceController::class, 'create'])->name('invoice.create');
        Route::post('/', [InvoiceController::class, 'save'])->name('invoice.store');
        Route::get('/{id}', [InvoiceController::class, 'edit'])->name('invoice.edit');
        Route::put('/{id}', [InvoiceController::class, 'update'])->name('invoice.update');
        Route::get('/{id}/status', [InvoiceController::class, 'status'])->name('invoice.status');
        Route::get('/invoice/trash', [InvoiceController::class, 'trash'])->name('invoice.trash');
        Route::get('/invoice/all', [InvoiceController::class, 'allinvoice'])->name('invoice.allinvoice');
        Route::delete('/{id}', [InvoiceController::class, 'deleteProduct'])->name('invoice.delete_product');
        Route::delete('/{id}/delete', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
        Route::get('/{id}/print', [InvoiceController::class, 'generateInvoice'])->name('invoice.print');
        Route::get('/{id}/print2', [InvoiceController::class, 'generateInvoice2'])->name('invoice.print2');
        Route::get('/cari/create', [InvoiceController::class, 'cari'])->name('create.cari');
        Route::get('/pengiriman/{id}', [InvoiceController::class, 'pengiriman'])->name('invoice.kirim');
        Route::put('/simpan/pengiriman/{id}', [InvoiceController::class, 'savepengiriman'])->name('invoice.simpankirim');
        Route::delete('/{id}/delete/pengiriman', [InvoiceController::class, 'deletepengiriman'])->name('invoice.deletepengiriman');
       
    });
    Route::get('/add/nondanppn', [HomeController::class, 'invoicenondanppn']);

    Route::group(['prefix' => 'invoiceppn'], function () {
        Route::get('/', [InvoiceppnController::class, 'index'])->name('invoiceppn.index');
        Route::get('/new', [InvoiceppnController::class, 'create'])->name('invoiceppn.create');
        Route::post('/', [InvoiceppnController::class, 'save'])->name('invoiceppn.store');
        Route::get('/{id}', [InvoiceppnController::class, 'edit'])->name('invoiceppn.edit');
        Route::put('/{id}', [InvoiceppnController::class, 'update'])->name('invoiceppn.update');
        Route::get('/{id}/status', [InvoiceppnController::class, 'status'])->name('invoiceppn.status');
        Route::get('/invoiceppn/trash', [InvoiceppnController::class, 'trash'])->name('invoiceppn.trash');
        Route::get('/invoiceppn/all', [InvoiceppnController::class, 'allinvoice'])->name('invoiceppn.allinvoice');
        Route::delete('/{id}', [InvoiceppnController::class, 'deleteProduct'])->name('invoiceppn.delete_product');
        Route::delete('/{id}/delete', [InvoiceppnController::class, 'destroy'])->name('invoiceppn.destroy');
        Route::get('/{id}/print', [InvoiceppnController::class, 'generateInvoice'])->name('invoiceppn.print');
        Route::get('/{id}/print2', [InvoiceppnController::class, 'generateInvoice2'])->name('invoiceppn.print2');
        Route::get('/cari/createppn', [InvoiceppnController::class, 'cari'])->name('createppn.cari');
        Route::get('/pengiriman/{id}', [InvoiceppnController::class, 'pengirimanppn'])->name('invoiceppn.pengirimanppn');
        Route::put('/simpan/pengiriman/{id}', [InvoiceppnController::class, 'savepengirimanppn'])->name('invoiceppn.simpanpengirimanppn');
        Route::delete('/{id}/delete/pengiriman', [InvoiceppnController::class, 'deletepengirimanppn'])->name('invoiceppn.deletepengirimanppn');
    });
    Route::get('/laporan-penjualan', [LaporanController::class, 'index']);
    Route::get('/cari', [LaporanController::class, 'cari']);
    Route::get('/carippn', [LaporanController::class, 'carippn']);
    Route::get('/laporan-barang', [LaporanBarangController::class, 'index']);
    Route::get('/barang-print', [LaporanBarangController::class, 'printlapbarang']);

    Route::group(['prefix' => 'penawaran'], function () {
        Route::get('/', [PenawaranController::class, 'index'])->name('penawaran.index');
        Route::get('/all', [PenawaranController::class, 'allpenawaran'])->name('penawaran.allpenawaran');
        Route::get('/new', [PenawaranController::class, 'create']); 
        Route::post('/', [PenawaranController::class, 'save']);
        Route::get('/detail/{id}', [PenawaranController::class, 'detail'])->name('detail.penawaran');
        Route::post('/save-kondisi', [PenawaranController::class, 'savekondisi']);
        Route::post('/save-harga', [PenawaranController::class, 'saveharga']);
        Route::get('/print/{id}', [PenawaranController::class, 'printpenawaran'])->name('print.penawaran');
        Route::delete('/delete/kondisi/{id}', [PenawaranController::class, 'destroyKondisi']);
        Route::delete('/delete/harga/{id}', [PenawaranController::class, 'destroyHarga']);
        Route::delete('/delete/{id}', [PenawaranController::class, 'destroy']);
        Route::get('/cari/penawaran', [PenawaranController::class, 'cari'])->name('cari.penawaran');
    });
    Route::group(['prefix' => 'daily-report-marketing'], function () {
        Route::get('/', [DailyReportMarketingController::class, 'index']);
        Route::get('/all', [DailyReportMarketingController::class, 'alldailyreportmkt']);
        Route::get('/new', [DailyReportMarketingController::class, 'create']);
        Route::post('/', [DailyReportMarketingController::class, 'save']);
        Route::get('/detail/{id}', [DailyReportMarketingController::class, 'detail'])->name('detail.dailyreportmkt');
        Route::post('/save-detail/{id}', [DailyReportMarketingController::class, 'savedetail']);
        Route::get('/lihat/{id}', [DailyReportMarketingController::class, 'lihatdetail'])->name('lihat.dailyreportmkt');
        Route::delete('/delete/detail/{id}', [DailyReportMarketingController::class, 'destroydetail']);
        Route::delete('/delete/{id}', [DailyReportMarketingController::class, 'destroy']);
        Route::get('/cari', [DailyReportMarketingController::class, 'cari'])->name('cari.dailyreportmkt');
        Route::get('/print/{id}', [DailyReportMarketingController::class, 'printdailyreportmkt'])->name('print.dailyreportmkt');
    });
    Route::group(['prefix' => 'hemoglobin-yofalab'], function () {
        Route::get('/', [HemoglobinYofalabController::class, 'index'])->name('hbyofalab.index');
        Route::get('/new', [HemoglobinYofalabController::class, 'create']); 
        Route::post('/', [HemoglobinYofalabController::class, 'save']);
        Route::get('/detail/{id}', [HemoglobinYofalabController::class, 'detail'])->name('detail.hbyofalab');
        Route::post('/save-detail', [HemoglobinYofalabController::class, 'savedetail']);
        Route::get('/lihat/{id}', [HemoglobinYofalabController::class, 'lihatdetail'])->name('lihat.hbyofalab');
        Route::delete('/delete/detail/{id}', [HemoglobinYofalabController::class, 'destroydetail']);
        Route::delete('/delete/{id}', [HemoglobinYofalabController::class, 'destroy']);
        Route::get('/print', [HemoglobinYofalabController::class, 'printhbyofalab'])->name('print.hbyofalab');
        Route::get('/cari', [HemoglobinYofalabController::class, 'cari'])->name('cari.hbyofalab');
        Route::get('/signaturepad', [HemoglobinYofalabController::class, 'signaturepad']);
        Route::post('/signaturepad/upload', [HemoglobinYofalabController::class, 'upload'])->name('signaturepad.upload');
    });
    
    Route::group(['prefix' => 'hemochroma'], function () {
        Route::get('/', [HemochromaController::class, 'index'])->name('hemocrhoma.index');
        Route::get('/new', [HemochromaController::class, 'create']); 
        Route::post('/', [HemochromaController::class, 'save']);
        Route::get('/detail/{id}', [HemochromaController::class, 'detail'])->name('detail.hemochroma');
        Route::post('/save-detail', [HemochromaController::class, 'savedetail']);
        Route::get('/lihat/{id}', [HemochromaController::class, 'lihatdetail'])->name('lihat.hemochroma');
        Route::delete('/delete/detail/{id}', [HemochromaController::class, 'destroydetail']);
        Route::delete('/delete/{id}', [HemochromaController::class, 'destroy']);
        Route::get('/print', [HemochromaController::class, 'printhemochroma'])->name('print.hemochroma');
        Route::get('/cari', [HemochromaController::class, 'cari'])->name('cari.hemochroma');
    });
    //  Route::group(['prefix' => 'customer-order'], function () {
    //     Route::get('/allinvoice/customer', [InvoiceCustomerController::class, 'allinvoicecustomer'])->name('invoicecustomer.allinvoice');
    //     Route::get('/{id}/print', [InvoiceCustomerController::class, 'generateInvoice'])->name('invoicecustomer.print');
    //     Route::get('/{id}/printnonppn', [InvoiceCustomerController::class, 'generateInvoiceNonPPN'])->name('invoicecustomer.printnonppn');
    // });
    
    Route::group(['prefix' => 'soal'], function () {
        Route::get('/', [SoalController::class, 'index']);
        Route::get('/hasiltest', [SoalController::class, 'hasiltest']);
        Route::get('/new', [SoalController::class, 'buat_soal']);
        Route::post('/', [SoalController::class, 'save']);
        Route::get('/isisoal/{id}', [SoalController::class, 'isi_soal'])->name('soal.isi_soal');
        Route::post('/savesoal', [SoalController::class, 'savesoal']);
        Route::delete('/delete/soal/{id}', [SoalController::class, 'destroysoal']);
        Route::get('/testsoal/{id}', [SoalController::class, 'testsoal']);
        Route::post('/savejawaban', [SoalController::class, 'savejawaban'])->name('save.jawaban');
        Route::get('/{id}/print', [SoalController::class, 'generateInvoice'])->name('soal.print');
    });
    
     Route::group(['prefix' => 'service-kendaraan'], function () {
        Route::get('/', [ServiceKendaraanController::class, 'index'])->name('service.kendaraan.index');
        Route::get('/new', [ServiceKendaraanController::class, 'create']);
        Route::post('/', [ServiceKendaraanController::class, 'save']);
        Route::get('/detail/{id}', [ServiceKendaraanController::class, 'detail'])->name('service_kendaraan.detail');
        Route::post('/savedetail', [ServiceKendaraanController::class, 'savedetail'])->name('service.save.detail');
        Route::delete('/delete/detail/{id}', [ServiceKendaraanController::class, 'destroydetail']);
        Route::get('/{id}/print', [ServiceKendaraanController::class, 'print'])->name('service_kendaraan.print');
    });

});


Route::group(['middleware' => ['auth', 'ceklevel:superadmin,marketing']], function () {
    Route::group(['prefix' => 'invoice'], function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/new', [InvoiceController::class, 'create'])->name('invoice.create');
        Route::post('/', [InvoiceController::class, 'save'])->name('invoice.store');
        Route::get('/{id}', [InvoiceController::class, 'edit'])->name('invoice.edit');
        Route::put('/{id}', [InvoiceController::class, 'update'])->name('invoice.update');
        Route::delete('/{id}', [InvoiceController::class, 'deleteProduct'])->name('invoice.delete_product');
        Route::get('/cari/create', [InvoiceController::class, 'cari'])->name('create.cari');
        
    });
    Route::get('/add/nondanppn', [HomeController::class, 'invoicenondanppn']);
    Route::get('/menuorder', [HomeController::class, 'invoicenondanppnapp']);
    
    Route::group(['prefix' => 'invoiceppn'], function () {
        Route::get('/', [InvoiceppnController::class, 'index'])->name('invoiceppn.index');
        Route::get('/new', [InvoiceppnController::class, 'create'])->name('invoiceppn.create');
        Route::post('/', [InvoiceppnController::class, 'save'])->name('invoiceppn.store');
        Route::get('/{id}', [InvoiceppnController::class, 'edit'])->name('invoiceppn.edit');
        Route::put('/{id}', [InvoiceppnController::class, 'update'])->name('invoiceppn.update');
        Route::delete('/{id}', [InvoiceppnController::class, 'deleteProduct'])->name('invoiceppn.delete_product');
        Route::get('/cari/createppn', [InvoiceppnController::class, 'cari'])->name('createppn.cari');
    });
    
    Route::group(['prefix' => 'penawaran'], function () {
        Route::get('/', [PenawaranController::class, 'index'])->name('penawaran.index');
        Route::get('/new', [PenawaranController::class, 'create']); 
        Route::post('/', [PenawaranController::class, 'save']);
        Route::get('/detail/{id}', [PenawaranController::class, 'detail'])->name('detail.penawaran');
        Route::post('/save-kondisi', [PenawaranController::class, 'savekondisi']);
        Route::post('/save-harga', [PenawaranController::class, 'saveharga']);
        Route::get('/print/{id}', [PenawaranController::class, 'printpenawaran'])->name('print.penawaran');
        Route::delete('/delete/kondisi/{id}', [PenawaranController::class, 'destroyKondisi']);
        Route::delete('/delete/harga/{id}', [PenawaranController::class, 'destroyHarga']);
        Route::delete('/delete/{id}', [PenawaranController::class, 'destroy']);
        Route::get('/cari/penawaran', [PenawaranController::class, 'cari'])->name('cari.penawaran');
    });
    
    Route::group(['prefix' => 'daily-report-marketing'], function () {
        Route::get('/', [DailyReportMarketingController::class, 'index']);
        Route::get('/new', [DailyReportMarketingController::class, 'create']);
        Route::post('/', [DailyReportMarketingController::class, 'save']);
        Route::get('/detail/{id}', [DailyReportMarketingController::class, 'detail'])->name('detail.dailyreportmkt');
        Route::post('/save-detail/{id}', [DailyReportMarketingController::class, 'savedetail']);
        Route::get('/lihat/{id}', [DailyReportMarketingController::class, 'lihatdetail'])->name('lihat.dailyreportmkt');
        Route::delete('/delete/detail/{id}', [DailyReportMarketingController::class, 'destroydetail']);
        Route::delete('/delete/{id}', [DailyReportMarketingController::class, 'destroy']);
        Route::get('/cari', [DailyReportMarketingController::class, 'cari'])->name('cari.dailyreportmkt');
        Route::get('/print/{id}', [DailyReportMarketingController::class, 'printdailyreportmkt'])->name('print.dailyreportmkt');
    });
    
     Route::group(['prefix' => 'soal'], function () {
        Route::get('/', [SoalController::class, 'index']);
        Route::get('/testsoal/{id}', [SoalController::class, 'testsoal']);
        Route::post('/savejawaban', [SoalController::class, 'savejawaban'])->name('save.jawaban');
        Route::get('/{id}/print', [SoalController::class, 'generateInvoice'])->name('soal.print');
    });
    
    Route::group(['prefix' => 'service-kendaraan'], function () {
        Route::get('/', [ServiceKendaraanController::class, 'index'])->name('service.kendaraan.index');
        Route::get('/new', [ServiceKendaraanController::class, 'create']);
        Route::post('/', [ServiceKendaraanController::class, 'save']);
        Route::get('/detail/{id}', [ServiceKendaraanController::class, 'detail'])->name('service_kendaraan.detail');
        Route::post('/savedetail', [ServiceKendaraanController::class, 'savedetail'])->name('service.save.detail');
        Route::delete('/delete/detail/{id}', [ServiceKendaraanController::class, 'destroydetail']);
        Route::get('/{id}/print', [ServiceKendaraanController::class, 'print'])->name('service_kendaraan.print');
    });

    Route::get('/laporan-barang', [LaporanBarangController::class, 'index']);
    Route::get('/barang-print', [LaporanBarangController::class, 'printlapbarang']);
    
});


Route::group(['middleware' => ['auth', 'ceklevel:superadmin,marketing,marketingcustomer']], function () {
    
    Route::group(['prefix' => 'penawaran'], function () {
        Route::get('/', [PenawaranController::class, 'index'])->name('penawaran.index');
        Route::get('/new', [PenawaranController::class, 'create']); 
        Route::post('/', [PenawaranController::class, 'save']);
        Route::get('/detail/{id}', [PenawaranController::class, 'detail'])->name('detail.penawaran');
        Route::post('/save-kondisi', [PenawaranController::class, 'savekondisi']);
        Route::post('/save-harga', [PenawaranController::class, 'saveharga']);
        Route::get('/print/{id}', [PenawaranController::class, 'printpenawaran'])->name('print.penawaran');
        Route::delete('/delete/kondisi/{id}', [PenawaranController::class, 'destroyKondisi']);
        Route::delete('/delete/harga/{id}', [PenawaranController::class, 'destroyHarga']);
        Route::delete('/delete/{id}', [PenawaranController::class, 'destroy']);
        Route::get('/cari/penawaran', [PenawaranController::class, 'cari'])->name('cari.penawaran');
    });
    
    Route::group(['prefix' => 'daily-report-marketing'], function () {
        Route::get('/', [DailyReportMarketingController::class, 'index']);
        Route::get('/new', [DailyReportMarketingController::class, 'create']);
        Route::post('/', [DailyReportMarketingController::class, 'save']);
        Route::get('/detail/{id}', [DailyReportMarketingController::class, 'detail'])->name('detail.dailyreportmkt');
        Route::post('/save-detail/{id}', [DailyReportMarketingController::class, 'savedetail']);
        Route::get('/lihat/{id}', [DailyReportMarketingController::class, 'lihatdetail'])->name('lihat.dailyreportmkt');
        Route::delete('/delete/detail/{id}', [DailyReportMarketingController::class, 'destroydetail']);
        Route::delete('/delete/{id}', [DailyReportMarketingController::class, 'destroy']);
        Route::get('/cari', [DailyReportMarketingController::class, 'cari'])->name('cari.dailyreportmkt');
        Route::get('/print/{id}', [DailyReportMarketingController::class, 'printdailyreportmkt'])->name('print.dailyreportmkt');
    });
    
     Route::group(['prefix' => 'soal'], function () {
        Route::get('/', [SoalController::class, 'index']);
        Route::get('/testsoal/{id}', [SoalController::class, 'testsoal']);
        Route::post('/savejawaban', [SoalController::class, 'savejawaban'])->name('save.jawaban');
        Route::get('/{id}/print', [SoalController::class, 'generateInvoice'])->name('soal.print');
    });
    
    Route::group(['prefix' => 'service-kendaraan'], function () {
        Route::get('/', [ServiceKendaraanController::class, 'index'])->name('service.kendaraan.index');
        Route::get('/new', [ServiceKendaraanController::class, 'create']);
        Route::post('/', [ServiceKendaraanController::class, 'save']);
        Route::get('/detail/{id}', [ServiceKendaraanController::class, 'detail'])->name('service_kendaraan.detail');
        Route::post('/savedetail', [ServiceKendaraanController::class, 'savedetail'])->name('service.save.detail');
        Route::delete('/delete/detail/{id}', [ServiceKendaraanController::class, 'destroydetail']);
        Route::get('/{id}/print', [ServiceKendaraanController::class, 'print'])->name('service_kendaraan.print');
    });

    Route::get('/laporan-barang', [LaporanBarangController::class, 'index']);
    Route::get('/barang-print', [LaporanBarangController::class, 'printlapbarang']);
    
});

Route::group(['middleware' => ['auth', 'ceklevel:superadmin,customer,admin']], function () {
    Route::group(['prefix' => 'customer-order'], function () {
        Route::get('/', [InvoiceCustomerController::class, 'index']);
        Route::post('/', [InvoiceCustomerController::class, 'save'])->name('invoicecustomer.store');
        Route::get('/{id}', [InvoiceCustomerController::class, 'edit'])->name('invoicecustomer.edit');
        Route::put('/{id}', [InvoiceCustomerController::class, 'update'])->name('invoicecustomer.update');
        Route::delete('/{id}', [InvoiceCustomerController::class, 'deleteProduct'])->name('invoicecustomer.delete_product');
        Route::get('/{id}/print', [InvoiceCustomerController::class, 'generateInvoice'])->name('invoicecustomer.print');
        Route::get('/{id}/printnonppn', [InvoiceCustomerController::class, 'generateInvoiceNonPPN'])->name('invoicecustomer.printnonppn');
      //  Route::post('/invoicecustomer/{id}/payment', [InvoiceCustomerController::class,'processPayment'])->name('invoicecustomer.payment');
        
    });
});


