<main class="container mx-auto px-6 py-10 flex flex-col">
    <h2 class="text-3xl font-bold text-center text-[#DB9ECF]">Utilisateurs</h2>

    <div class="w-full mb-6 space-x-0 space-y-2 flex flex-wrap md:flex-nowrap md:space-x-4 md:space-y-0 items-center button-group-mobile">
        <button id="page1" class="h-12 p-2 font-[Cantarell] font-semibold rounded-md text-white bg-[#DB9ECF] hover:bg-white hover:text-[#DB9ECF] duration-200 w-full md:w-auto" onclick="changePage(false)">Utilisateurs en attente</button>
        <button id="page2" class="h-12 p-2 font-[Cantarell] font-semibold rounded-md text-white bg-[#DB9ECF] hover:bg-white hover:text-[#DB9ECF] duration-200 w-full md:w-auto" onclick="changePage(true)">Liste des utilisateurs</button>
    </div>

    <?php if (isset($message)) : ?>
        <p class="text-stone-800 p-4 text-center"><?= $message; ?></p>
    <?php endif; ?>

    <div class="overflow-x-auto" id="waiters">
        <?php if (!empty($waiters)) { ?>
            <table class="table w-full border-collapse bg-white shadow-lg rounded-lg overflow-hidden">
                <thead class="bg-[#DB9ECF] text-white">
                    <tr>
                        <th class="p-4 text-left">Nom</th>
                        <th class="p-4 text-left">Prénom</th>
                        <th class="p-4 text-left">Email</th>
                        <th class="p-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($waiters as $waiter) : ?>
                        <tr class="border-b hover:bg-gray-50 transition duration-200">
                            <td class="p-4"><?= htmlspecialchars($waiter['nom']); ?></td>
                            <td class="p-4"><?= htmlspecialchars($waiter['prenom']); ?></td>
                            <td class="p-4"><?= htmlspecialchars($waiter['email']); ?></td>
                            <td class="p-4">
                                <form action="index.php?page=updateUser" method="post" class="flex md:flex-row form-action-mobile md:justify-end md:items-start space-x-0 md:space-x-4">
                                    <input type="hidden" name="user_id" value="<?= $waiter['id']; ?>">
                                    <select name="new_role" class="px-[80px] py-[20px] border rounded-md focus:ring focus:ring-blue-300 text-left w-full md:w-auto">
                                        <?php foreach ($roles as $role) { ?>
                                            <option value="<?= $role['id'] ?>"><?= $role['nom'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <button type="submit" class="bg-[#DB9ECF] text-white px-[80px] py-[20px] rounded-lg hover:bg-[#c085b7] transition-colors text-base sm:text-lg flex items-center justify-center w-full md:w-[300px]">
                                        Modifier
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <h3 class="w-full h-12 text-2xl font-[Cantarell] text-center">Aucun utilisateur en attente</h3>
        <?php } ?>
    </div>

    <div class="overflow-x-auto" id="users">
        <table class="table w-full border-collapse bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-[#DB9ECF] text-white">
                <tr>
                    <th class="p-4 w-1/6 text-left">Nom</th>
                    <th class="p-4 w-1/6 text-left">Prénom</th>
                    <th class="p-4 w-1/6 text-left">Email</th>
                    <th class="p-4 w-1/6 text-left">Rôle</th>
                    <th class="p-4 w-1/6 text-left">Mot de passe</th>
                    <th class="p-4 w-1/6 text-left text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr id="<?php echo $user['email'] ?>" class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="p-4 w-1/6"><?= htmlspecialchars($user['nom']); ?></td>
                        <td class="p-4 w-1/6"><?= htmlspecialchars($user['prenom']); ?></td>
                        <td class="p-4 w-1/6"><?= htmlspecialchars($user['email']); ?></td>
                        <td class="p-4 w-1/6"><?= htmlspecialchars($user['nom_role']); ?></td>
                        <td class="p-4 w-1/6"><input value="Mot de passe" disabled type="password" aria-label="Mot de passe masqué"></td>
                        <td class="p-4 w-1/6 text-center align-middle">
                            <div class="flex justify-center gap-2">
                                <button class="p-2 bg-gray-100 rounded hover:bg-gray-200 transition edit-button" aria-label="Modifier l'utilisateur">
                                    <svg width="36" height="36" viewBox="-10 -10 100 100" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 80 L80 20 L60 0 L0 60 Z" fill="#DB9ECF" />
                                        <rect x="0" y="60" width="20" height="20" fill="#FFC1CC" />
                                        <polygon points="80,20 60,0 70,10" fill="#333333" />
                                    </svg>
                                </button>
                                <form method="POST" action="index.php?page=deleteUser" onsubmit="return confirm('Voulez-vous vraiment supprimer <?php echo $user['nom'] . ' ' . $user['prenom']; ?> ?')" class="inline">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="p-2 bg-red-100 rounded hover:bg-red-200 transition" aria-label="Supprimer l'utilisateur">
                                        <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" fill="#EF4444" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr id="<?php echo $user['email'] ?>" class="border-b hover:bg-gray-50 transition duration-200 editzone">
                        <form method="POST" action="index.php?page=updateUserInfo">
                            <input type="hidden" value="<?= $user['id'] ?>" name="user_id">
                            <td class="p-4 w-1/6"><input name="nom" class="w-full h-10 rounded-md indent-1 bg-[#F7F5EE] shadow-inner" type="text" value="<?= htmlspecialchars($user['nom']); ?>"></td>
                            <td class="p-4 w-1/6"><input name="prenom" class="w-full h-10 rounded-md indent-1 bg-[#F7F5EE] shadow-inner" type="text" value="<?= htmlspecialchars($user['prenom']); ?>"></td>
                            <td class="p-4 w-1/6"><input name="email" class="w-full h-10 rounded-md indent-1 bg-[#F7F5EE] shadow-inner" type="text" value="<?= htmlspecialchars($user['email']); ?>"></td>
                            <td class="p-4 w-1/6">
                                <select name="new_role" class="w-full h-10 indent-1 border rounded-md focus:ring focus:ring-blue-300">
                                    <?php foreach ($roles as $role) { ?>
                                        <option <?= $role['id'] == $user['id_role'] ? 'selected' : '' ?> value="<?= $role['id'] ?>"><?= $role['nom'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="p-4 w-1/6"><input name="password" class="w-full h-10 rounded-md indent-1 bg-[#F7F5EE] shadow-inner" value="" type="password" aria-label="Nouveau mot de passe"></td>
                            <td class="p-4 w-1/6 text-center align-middle">
                                <div class="flex md:flex-row form-action-mobile justify-center gap-2">
                                    <button class="p-2 bg-green-100 rounded hover:bg-green-200 transition valid-button" aria-label="Valider la modification">
                                        <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" fill="#DB9ECF" />
                                        </svg>
                                    </button>
                                    <button type="reset" class="p-2 bg-red-100 rounded hover:bg-red-200 transition reset-button" aria-label="Annuler la modification">
                                        <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 6l12 12M18 6L6 18" stroke="#DB9ECF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script src="/assets/js/user.js"></script>
