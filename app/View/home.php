<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        const base_url = "<?= base_url(); ?>";
    </script>
</head>
<body>
    <div class="container mt-5 ">
        <div class="row justify-content-center">
            <div class="d-grid gap-2">
                <a href="<?= base_url(); ?>contact/create" class="btn btn-primary">Add contact</a>
            </div>

            <div class="row mt-3">
                <?php foreach ($data['contacts'] as $contact): ?>
                    <div class="col-md-4 pt-3">
                        <div class="card">
                            <img src="<?= base_url()?>/assets/img/<?=$contact['coct_url_img_profile'] ?>" alt="" class="card-img-top">
                            <div class="card-body">
                            <h5 class="card-title">Name: <?= $contact['coct_name'] ?> <?= $contact['coct_last_name'] ?></h5>
                                <p class="card-text">Age: <?= $contact['coct_age'] ?></p>
                                <p class="card-text">Email: <?= $contact['coct_email'] ?></p>
                                <p class="card-text">Description: <?= $contact['coct_description'] ?></p>
                                <a href="<?= base_url(); ?>contact/edit/<?= $contact['coct_id_contact'] ?>" class="btn btn-primary">Edit</a>
                                <button class="btn btn-danger delete" data-id="<?= $contact['coct_id_contact'] ?>">Delete</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>