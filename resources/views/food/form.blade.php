{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Form</title>
</head>
<body> --}}

    {{-- <form action="{{ route('addFood', ['id' => $food->id]) }}" method="post">
        @csrf
        <button type="submit">Add to Daily Calories</button>
    </form> --}}
    
<form action="{{ url('/food/process') }}" method="post">
    @csrf

    <label for="name">Food Name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" required><br>

    <label for="calories">Calories:</label>
    <input type="number" id="calories" name="calories" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="vegetarian_option">Vegetarian Option:</label>
    <input type="checkbox" id="vegetarian_option" name="vegetarian_option"><br>

    <input type="submit" value="Submit">
</form>

{{-- </body>
</html> --}}