<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows(Product::PRODUCT_INDEX)) {
            return redirect()->route('admin.index');
        }

        $products = Product::query()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows(Product::PRODUCT_CREATE)) {
            return redirect()->route('admin.products.index');
        }

        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows(Product::PRODUCT_CREATE)) {
            return redirect()->route('admin.products.index');
        }

        $validData = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:150'],
            'title' => ['required', 'string', 'min:2', 'max:150'],
            'price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'image' => ['required', 'image'],
            'colors' => ['required', 'array'],
            'colors.*' => ['required', 'string'],
        ], [
            'name.required' => 'نام باید حتما وارد شده باشد.',
            'name.string' => 'نام باید حتما کارکتر باشد.',
            'name.min' => 'نام باید حداقل :min کارکتر باشد.',
            'name.max' => 'نام باید حداکثر :max کارکتر باشد.',

            'title.required' => 'توضیحات باید حتما وارد شده باشد.',
            'title.string' => 'توضیحات باید حتما کارکتر باشد.',
            'title.min' => 'توضیحات باید حداقل :min کارکتر باشد.',
            'title.max' => 'توضیحات باید حداکثر :max کارکتر باشد.',

            'price.required' => 'قیمت باید حتما وارد شده باشد.',
            'price.integer' => 'قیمت باید عددی باشد.',

            'quantity.required' => 'قیمت باید حتما وارد شده باشد.',
            'quantity.integer' => 'قیمت باید عددی باشد.',

            'image.required' => 'عکس باید حتما وارد شده باشد.',
            'image.image' => 'فایل باید حتما عکس باشد.',

            'colors.required' => 'حداقل یک رنگ باید انتخاب شده باشد.',
            'colors.*.required' => 'حداقل یک رنگ باید انتخاب شده باشد.',
            'colors.*.string' => 'رنگ باید حتما کارکتر باشد.',
        ]);

        try {
            $validData['slug'] = str_replace(' ', '-', $validData['name']);
            $validData['colors'] = json_encode($validData['colors']);

            $image = $validData['image'];

            $randomName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images/products', $randomName, 'public');

            $product = Product::query()->create($validData);
            $product->image()->create(['image' => $randomName]);

            return redirect()->route('admin.products.index');
        } catch (\Exception) {
            return back()->withErrors('خطای سرور');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Application|Factory|RedirectResponse|ApplicationAlias
    {
        if (!Gate::allows(Product::PRODUCT_EDIT)) {
            return redirect()->route('admin.products.index');
        }

        $product = Product::query()->findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows(Product::PRODUCT_EDIT)) {
            return redirect()->route('admin.products.index');
        }

        $validData = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:150'],
            'title' => ['required', 'string', 'min:2', 'max:150'],
            'price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'image' => ['nullable', 'image'],
            'colors' => ['required', 'array'],
            'colors.*' => ['required', 'string'],
        ], [
            'name.required' => 'نام باید حتما وارد شده باشد.',
            'name.string' => 'نام باید حتما کارکتر باشد.',
            'name.min' => 'نام باید حداقل :min کارکتر باشد.',
            'name.max' => 'نام باید حداکثر :max کارکتر باشد.',

            'title.required' => 'توضیحات باید حتما وارد شده باشد.',
            'title.string' => 'توضیحات باید حتما کارکتر باشد.',
            'title.min' => 'توضیحات باید حداقل :min کارکتر باشد.',
            'title.max' => 'توضیحات باید حداکثر :max کارکتر باشد.',

            'price.required' => 'قیمت باید حتما وارد شده باشد.',
            'price.integer' => 'قیمت باید عددی باشد.',

            'quantity.required' => 'قیمت باید حتما وارد شده باشد.',
            'quantity.integer' => 'قیمت باید عددی باشد.',

            'image.image' => 'فایل باید حتما عکس باشد.',

            'colors.required' => 'حداقل یک رنگ باید انتخاب شده باشد.',
            'colors.*.required' => 'حداقل یک رنگ باید انتخاب شده باشد.',
            'colors.*.string' => 'رنگ باید حتما کارکتر باشد.',
        ]);

        try {
            $validData['slug'] = str_replace(' ', '-', $validData['name']);
            $validData['colors'] = json_encode($validData['colors']);

            $product = Product::query()->findOrFail($id);
            $product->update($validData);

            if (isset($validData['image'])) {
                $image = $validData['image'];
                $existingImage = $product->image;

                $randomName = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/products', $randomName, 'public');
                $existingImage->update(['image' => $randomName]);
            }

            return redirect()->route('admin.products.index');
        } catch (\Exception) {
            return back()->withErrors('خطای سرور');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return back();
    }
}
