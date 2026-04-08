<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Ingredient</title>
    @include('layout.head')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-gray-50">

    @include('layout.sidebar')

    <main class="md:ml-64 xl:ml-72 2xl:ml-72">
        @include('layout.navbar')

        <div class="p-5">
            <div class='w-full bg-white rounded-xl h-fit mx-auto'>
                <div class="p-3 text-center">
                    <h1 class="font-extrabold text-3xl">Edit Ingredient</h1>
                </div>
                <div class="p-6">
                    <form class="space-y-3" method="post" action="{{ route('updateingridient', $menu->id) }}">
                        @csrf
                        @method('put')

                        <!-- Product -->
                        <div class="space-y-2">
                            <label class="font-semibold text-black">Product:</label>
                            <select name="menu_id"
                                class="bg-gray-200 border border-gray-300 text-gray-900 p-2 rounded-lg w-full" disabled>
                                <option value="{{ $menu->id }}" selected>{{ $menu->name }}</option>
                            </select>
                        </div>

                        <!-- Ingredient Rows -->
                        <div id="ingredient-wrapper" class="space-y-4">
                            @foreach ($menu->invents as $i => $inv)
                                <div class="ingredient-row flex justify-between">
                                    <select name="ingredients[{{ $i }}][invent_id]"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-1/2"
                                        required>
                                        <option></option>
                                        @foreach ($invents as $invent)
                                            <option value="{{ $invent->id }}"
                                                {{ $invent->id == $inv->pivot->invent_id ? 'selected' : '' }}>
                                                {{ $invent->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <input type="number" name="ingredients[{{ $i }}][quantity_used]"
                                        value="{{ $inv->pivot->quantity_used }}"
                                        placeholder="Quantity"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-1/3"
                                        required>

                                    <button type="button"
                                        class="remove-row bg-red-500 text-white p-2 px-4 rounded-xl hover:text-black">X</button>
                                </div>
                            @endforeach
                        </div>

                        <!-- Button Add Ingredient -->
                        <button type="button" id="addRow"
                            class="bg-green-500 text-white px-4 p-2 rounded-lg hover:text-black">+</button>

                        <!-- Submit -->
                        <button type="submit"
                            class="bg-blue-500 text-white p-4 w-full hover:text-black rounded-lg">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

<script>
  let index = {{ $menu->invents->count() }};
  const wrapper = document.getElementById("ingredient-wrapper");
  const addBtn = document.getElementById("addRow");

  addBtn.addEventListener("click", () => {
    const row = wrapper.querySelector(".ingredient-row").cloneNode(true);

    // update name sesuai index
    row.querySelector("select").name = `ingredients[${index}][invent_id]`;
    row.querySelector("input").name = `ingredients[${index}][quantity_used]`;

    // kosongkan value
    row.querySelector("select").value = "";
    row.querySelector("input").value = "";

    wrapper.appendChild(row);
    index++;
  });

  wrapper.addEventListener("click", e => {
    if (e.target.classList.contains("remove-row") && wrapper.children.length > 1) {
      e.target.closest(".ingredient-row").remove();
    }
  });
</script>

</body>
</html>
