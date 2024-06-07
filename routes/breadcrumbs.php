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

Breadcrumbs::for('product.index', function (BreadcrumbTrail $trail) {
    $trail->push('Product', route('product.index'));
});

// Home > edit
Breadcrumbs::for('product.edit', function (BreadcrumbTrail $trail,$id) {
    $trail->parent('product.index');
    $trail->push('Edit', route('product.edit',$id));
});
//home> add
Breadcrumbs::for('product.add', function (BreadcrumbTrail $trail) {
    $trail->parent('product.index');
    $trail->push('Edit', route('product.add'));
});





Breadcrumbs::for('customer.index', function (BreadcrumbTrail $trail) {
    $trail->push('Customer', route('customer.index'));
});


// Customer > edit
Breadcrumbs::for('customer.edit', function (BreadcrumbTrail $trail,$id) {
    $trail->parent('customer.index');
    $trail->push('Edit', route('customer.edit',$id));
});

//customer> add
Breadcrumbs::for('customer.add', function (BreadcrumbTrail $trail) {
    $trail->parent('customer.index');
    $trail->push('Edit', route('customer.add'));
});






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






Breadcrumbs::for('order.index', function (BreadcrumbTrail $trail) {
    $trail->push('order', route('order.index'));
});


// order > edit

Breadcrumbs::for('order.edit', function ($trail, $id) {
    $trail->parent('order.index'); // Assuming 'order.index' is your index route
    $order = \App\Models\categories::findOrFail($id); // Fetch the order
    $trail->push('Edit ' . $order->name, route('order.edit', $id));
});

//order> add
