<!DOCTYPE html>
    <html>
        <body>
            <?php if ( ! empty($contacts)): ?>
                <h4>My Conctact List</h4>
                    <ul>
                        <?php foreach($contacts as $v): ?>
                            <li>
                                <?php echo $v->names[0]->displayName; ?> - 
                                <?php echo $v->emailAddresses[0]->value; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
            <?php endif; ?>
        </body>
    </html>