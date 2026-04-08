<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Ingredient</title>
    @include('layout.head')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-gray-50">

    <!-- sidenav  -->
    @include('layout.sidebar')
    <!-- end sidenav -->
    <main class="md:ml-64 xl:ml-72 2xl:ml-72">
        <!-- Navbar -->
        @include('layout.navbar')
        <!-- end Navbar -->
        <div class="p-5">
            <div class='w-full bg-white rounded-xl h-fit mx-auto'>
                <div class="p-3 text-center">
                    <h1 class="font-extrabold text-3xl">Add Ingredient</h1>
                </div>
                <div class="p-6">
                    <form class="space-y-3" method="post" action="{{ route('postingridient') }}">
                        @csrf
                        @method('post')

                        <!-- Pilih Menu -->
                        <div class="space-y-2">
                            <label class="font-semibold text-black">Product:</label>
                            <select id="menu" name="menu_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full" required>
                                <option></option>
                                @foreach ($menus as $men)
                                    <option value="{{ $men->id }}">{{ $men->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ingredient Rows -->
                        <div id="ingredient-wrapper" class="space-y-4">
                            <div class="ingredient-row flex justify-between">
                                <select name="ingredients[0][invent_id]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-1/2"
                                    required>
                                    <option></option>

                                    @foreach ($invents as $inv)
                                        <option value="{{ $inv->id }}">{{ $inv->name }}</option>
                                    @endforeach
                                    
                                </select>

                                <input type="number" name="ingredients[0][quantity_used]" placeholder="Quantity"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-1/3"
                                    required>

                                <button type="button"
                                    class="remove-row bg-red-500 text-white p-2 px-4 rounded-xl hover:text-black">X</button>
                            </div>
                        </div>

                        <!-- Button Add Ingredient -->
                        <button type="button" id="addRow"
                            class="bg-green-500 text-white px-4 p-2 rounded-lg hover:text-black">+</button>

                        <!-- Submit -->
                        <button type="submit"
                            class="bg-blue-500 text-white p-4 w-full hover:text-black rounded-lg">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

<script>
  let index = 1;
  const wrapper = document.getElementById("ingredient-wrapper");
  const addBtn = document.getElementById("addRow");

  addBtn.addEventListener("click", () => {
    // clone row pertama
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

  // event delegation untuk tombol hapus
  wrapper.addEventListener("click", e => {
    if (e.target.classList.contains("remove-row") && wrapper.children.length > 1) {
      e.target.closest(".ingredient-row").remove();
    }
  });
</script>

    
</body>

</html>
