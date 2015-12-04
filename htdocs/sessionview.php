<pre>
    <?php
        print_r(posix_getpwuid(posix_geteuid()));
        session_start();
        print_r($_SESSION);
    ?>
</pre>
