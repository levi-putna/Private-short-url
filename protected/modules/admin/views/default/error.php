<section class="hbox stretch">
    <aside class="bg-light lter">
        <section class="vbox">
            <header class="bg-light dker header clearfix">
                <p class="h4">Error <?= $error['code']; ?></p>
            </header>
            <section class="scrollable hover w-f">

                <div class="row m-n">
                    <div class="col-sm-4 col-sm-offset-4">
                        <div class="text-center m-b-lg">
                            <h1 class="h animated bounceInDown"><?= $error['code']; ?></h1>
                        </div>

                        <p class="h4"><?= $error['message']; ?></p>

                    </div>
                </div>



            </section>
            <footer class="footer b-t bg-white-only">

            </footer>
        </section>
    </aside>
</section>