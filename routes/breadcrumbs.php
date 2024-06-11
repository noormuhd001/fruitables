<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home

Breadcrumbs::for('admindashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admindashboard'));
});


//PRODUCT
Breadcrumbs::for('product.index', function (BreadcrumbTrail $trail) {
    $trail->push('Product', route('product.index'));
});

// product > edit
Breadcrumbs::for('product.edit', function (BreadcrumbTrail $trail,$id) {
    $trail->parent('product.index');
    $trail->push('Edit', route('product.edit',$id));
});
//product> add
Breadcrumbs::for('product.add', function (BreadcrumbTrail $trail) {
    $trail->parent('product.index');
    $trail->push('Edit', route('product.add'));
});




//Customer
Breadcrumbs::for('customer.index', function (BreadcrumbTrail $trail) {
    $trail->push('Customer', route('customer.index'));
});


// Customer > edit
Breadcrumbs::for('customer.edit', function (BreadcrumbTrail $trail,$id) {
    $trail->parent('customer.index');
    $trail->push('Edit', route('customer.edit',$id));
});






//Category

Breadcrumbs::for('category.index', function (BreadcrumbTrail $trail) {
    $trail->push('category', route('category.index'));
});


// category > edit

Breadcrumbs::for('category.edit', function ($trail, $id) {
    $trail->parent('category.index'); // Assuming 'category.index' is your index route
    $category = \App\Models\categories::findOrFail($id); // Fetch the category
    $trail->push('Edit ' . $category->name, route('category.edit', $id));
});

//category> add
Breadcrumbs::for('category.add', function (BreadcrumbTrail $trail) {
    $trail->parent('category.index');
    $trail->push('Edit', route('category.add'));
});




//ORDER

Breadcrumbs::for('order.index', function (BreadcrumbTrail $trail) {
    $trail->push('order', route('order.index'));
});


// order > edit

Breadcrumbs::for('order.edit', function ($trail, $id) {
    $trail->parent('order.index'); // Assuming 'order.index' is your index route
    $order = \App\Models\categories::findOrFail($id); // Fetch the order
    $trail->push('Edit ' . $order->name, route('order.edit', $id));
});

//Offer

//offer.index
Breadcrumbs::for('offer.index', function (BreadcrumbTrail $trail) {
    $trail->push('Offer', route('offer.index'));
});

//OFFER> add
Breadcrumbs::for('offer.add', function (BreadcrumbTrail $trail) {
    $trail->parent('offer.index');
    $trail->push('Add', route('offer.add'));
});

Breadcrumbs::for('offer.edit', function ($trail, $id) {
    $trail->parent('offer.index'); // Assuming 'offer.index' is your index route
    $offer = \App\Models\offer::findOrFail($id); // Fetch the offer
    $trail->push('Edit ' . $offer->name, route('offer.edit', $id));
});

