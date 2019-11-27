
<div class="col-lg-12">
    <div class="col-lg-12">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col" colspan="4">MOODLE ÖĞRENCİLER</th>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Description</th>
            </tr>
            </thead>
            <tbody>
            <?php $b=1; foreach ($data['mdl_user'] as $user){ ?>
                <tr>
                    <th scope="row"><?php echo $b; ?></th>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['idnumber']; ?></td>
                    <td><?php echo $user['firstname']; ?></td>
                    <td><?php echo $user['lastname']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['description']; ?></td>
                </tr>
                <?php $b++; } ?>
            </tbody>
        </table>
    </div>
</div><!-- 12 -->



