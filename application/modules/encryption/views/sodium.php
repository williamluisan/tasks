<!DOCTYPE html>
    <html>
        <body>
            <h3 style="margin-bottom: 4px;">PHP Sodium Implementation</h3>
            - To <strong>encrypt</strong> use the combination of <strong>PRIVATE KEY A</strong> + <strong>PUBLIC KEY B</strong> + salt<br/>
            - To <strong>decrypt</strong> use the combination of <strong>PRIVATE KEY B</strong> + <strong>PUBLIC KEY A</strong> + salt
            <br/><br/>
            <form method="POST" action="">
                Plain/chiper text: <input type="text" name="string" style="margin-top: 6px;"/><br/>
                Public Key: <input type="text" name="public_key" style="margin-top: 6px;"/><br/>
                Private Key: <input type="text" name="private_key" style="margin-top: 6px;"/><br/>
                Salt: <input type="text" name="salt" style="margin-top: 6px;"/><br/><br/>

                <button name="choice" type="submit" value="1">Encrypt</button>
                <button name="choice" type="submit" value="2">Decrypt</button>
                <button name="choice" type="submit" value="3">Generate Your Key</button>
                <button type="submit">Clear</button>
            </form>
            <br/>

            <!-- encryption display -->
            <?php if (isset($encrypt)): ?>
                Chiper text: <strong><?php echo $encrypt['chipertext']; ?></strong>
            <?php endif; ?>

            <!-- decryption display -->
            <?php if (isset($decrypt)): ?>
                Plain text: <strong><?php echo $decrypt['plaintext']; ?></strong>
            <?php endif; ?>

            <!-- generate key display -->
            <?php if (isset($generate)): ?>
                Your keys:<br/>
                <ul>
                    <li>Public Key A: <?php echo $generate['public_key_A']?></li>
                    <li>Private Key A: <?php echo $generate['private_key_A']?></li>
                    <li>Public Key B: <?php echo $generate['public_key_B']?></li>
                    <li>Private Key B: <?php echo $generate['private_key_B']?></li>
                    <li>Salt: <?php echo $generate['salt']; ?></li>
                </ul>
            <?php endif; ?>
        </body>
    </html>