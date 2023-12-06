<h1>Basic Food</h1>
<p>Name: {{ $basicFood->getName() }}</p>
<p>Quantity: {{ $basicFood->getQuantity() }}</p>
<p>Calories: {{ $basicFood->getCalories() }}</p>
<p>Description: {{ $basicFood->getDescription() }}</p>

<hr>

<h1>Vegetarian Option</h1>
<p>Name: {{ $vegetarianPizza->getName() }}</p>
<p>Quantity: {{ $vegetarianPizza->getQuantity() }}</p>
<p>Calories: {{ $vegetarianPizza->getCalories() }}</p>
<p>Description: {{ $vegetarianPizza->getDescription() }}</p>