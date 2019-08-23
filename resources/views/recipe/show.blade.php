<h2>Product Name: </h2>
<p>{{ $recipe->recipes_name }} || ${{ $recipe->recipes_cost }}</p>

<h3>Ingredient Belongs to</h3>
<ul>
    @foreach($recipe->ingredients as $ingredient)
    <li>{{ $ingredient->ingredient_name }}</li>
    @endforeach
</ul>
