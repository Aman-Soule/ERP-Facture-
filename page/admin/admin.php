<div class="container">
    <div class="row mt-2 mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h1>ESPACE ADMINISTRATEUR</h1>
                </div>
                <div class="card-body">
                    <p><?= $_SESSION['nom'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="table">
            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>E-mail</th>
                    <th>tel</th>
                    <th>Etablissement</th>
                    <th>Satut</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($users as $key => $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= $u['nom'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td><?= $u['tel'] ?></td>
                        <td><?= $u['etablissement'] ?></td>

                        <td><?= $u['idrolef'] ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm mr-2">Modifier</button>
                            <button class="btn btn-danger btn-sm mr-2">Supprimer</button>
                        </td>
                    </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
