<div class="container">
    <div class="row mt-2 mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h1 class="text-center text-black-50">ESPACE ADMINISTRATEUR</h1>
                </div>
                <div class="card-body">
                    <p class="text-success"><?= $_SESSION['nom'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
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
                                <div class="btn-group-vertical btn-group-sm" role="group">
                                    <button class="btn btn-primary mb-1">Modifier</button>
                                    <button class="btn btn-danger">Supprimer</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styles supplémentaires pour améliorer la responsivité */
    @media (max-width: 768px) {
        .table-responsive {
            border: 0;
        }

        .table-responsive table {
            width: 100%;
            margin-bottom: 0;
        }

        .table-responsive .btn-group-vertical {
            min-width: 100px;
        }

        .table th,
        .table td {
            padding: 0.5rem;
            font-size: 0.875rem;
        }
    }

    @media (max-width: 576px) {
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table th,
        .table td {
            white-space: nowrap;
            min-width: 100px;
        }

        .table td:nth-child(7) {
            min-width: 120px;
        }

        h1 {
            font-size: 1.5rem;
        }

        .card-body p {
            font-size: 0.9rem;
            margin-bottom: 0;
        }
    }
</style>