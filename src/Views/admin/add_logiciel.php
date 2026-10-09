<main class="container mx-auto flex items-center flex-col p-4">
    <h2 class="text-3xl font-bold mt-6 my-8">Ajouter un logiciel</h2>
    <form action="index.php?page=addLogiciel" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded-lg shadow-md w-[50%]">
        <label class="block mt-2">Nom :</label>
        <input type="text" name="nom" required class="w-full p-2 border rounded">

        <div>
            <label class="block">Images :</label>
            <input type="file" name="image" accept="image/*"  class="w-full p-2 border rounded">
        </div>
        <button type="submit" class="bg-[#DB9ECF] text-white p-5 w-full rounded-xl hover:bg-[#c085b7] transition-colors mt-6 my-8">Ajouter</button>
    </form>
</main>