<?php

/**
 * Template Name: Style
 *
 * @package Glasswerks
 */

get_header(); ?>
<section style="padding-top: 150px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="display">Lorem Ipsum</h1>
                <h1>Lorem Ipsum</h1>
                <h2>The face of the moon was in shadow</h2>
                <h3>The face of the moon was in shadow</h3>
                <h4>The face of the moon was in shadow</h4>
                <h5>The face of the moon was in shadow</h5>
                <h6>The face of the moon was in shadow</h6>
                <br />
                <p class="text-20">The face of the moon was in shadow</p>
                <p class="text-18">The face of the moon was in shadow</p>
                <p class="text-16">The face of the moon was in shadow</p>
                <p class="text-14">The face of the moon was in shadow</p>
                <p class="text-12">The face of the moon was in shadow</p>
                <p>Quae fuerit causa, nollem me ab eo delectu rerum, quem modo dixi, constituto, ut labore et impetus
                    quo
                    ignorare vos arbitrer, sed animo etiam erga nos causae confidere, sed animo etiam ac ratione
                    voluptatem
                    et accurate disserendum et fortibus.

                    In quo quaerimus, non recusandae <a href="#">itaque negat opus esse</a> expetendam et aut
                    perferendis doloribus
                    asperiores repellat hanc ego assentior, cum soluta nobis est et accusamus et voluptatem sequi
                    nesciunt,
                    neque disputatione, quam interrogare aut dolores suscipiantur maiorum dolorum effugiendorum.

                    Torquatos nostros? quos dolores et argumentandum et dolore disputandum putant sed ut alterum
                    aspernandum
                    sentiamus alii autem, quibus ego assentior, cum a natura ipsa iudicari etenim quoniam detractis de
                    quo
                    voluptas assumenda est, necesse est, omnis iste natus error.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis laboriosam deserunt quas,
                    voluptates blanditiis nam veniam aut. Vero, autem laboriosam? Error molestiae, ipsam laboriosam
                    rerum
                    reiciendis placeat inventore soluta laudantium.</p>
                    <blockquote>
                        “We created a space that blends nature with innovation, providing a sustainable building that harmonizes with its environment while meeting community needs.”
                    </blockquote>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-6">
                <ul>
                    <li>Parent Item </li>
                    <li>Parent Item
                        <ul>
                            <li>Sub Item </li>
                            <li>Sub Item </li>
                            <li>Sub Item </li>
                        </ul>
                    </li>
                    <li>Parent Item
                        <ol>
                            <li>Sub Item </li>
                            <li>Sub Item </li>
                            <li>Sub Item </li>
                        </ol>
                    </li>
                    <li>Parent Item </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ol>
                    <li>Parent Item </li>
                    <li>Parent Item
                        <ol>
                            <li>Sub Item </li>
                            <li>Sub Item </li>
                            <li>Sub Item </li>
                        </ol>
                    </li>
                    <li>Parent Item
                        <ul>
                            <li>Sub Item </li>
                            <li>Sub Item </li>
                            <li>Sub Item </li>
                        </ul>
                    </li>
                    <li>Parent Item </li>
                </ol>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-6">
                <ol>
                    <li>#Parent Item </li>
                    <li>#Parent Item</li>
                    <li>#Parent Item</li>
                    <li>#Parent Item </li>
                    <li>#Parent Item </li>
                    <li>#Parent Item</li>
                    <li>#Parent Item</li>
                    <li>#Parent Item </li>
                </ol>
            </div>
            <div class="col-md-6">
                <ul>
                    <li>#Parent Item </li>
                    <li>#Parent Item</li>
                    <li>#Parent Item</li>
                    <li>#Parent Item </li>
                    <li>#Parent Item </li>
                    <li>#Parent Item</li>
                    <li>#Parent Item</li>
                    <li>#Parent Item </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <h2>Buttons</h2>
        <div class="py-4">
            <a href="javascript:;" class="btn btn-primary">Contact Us</a>
            <a href="javascript:;" class="btn btn-primary with-gradient">View All Products</a>
            <a href="javascript:;" class="btn btn-secondary">Contact</a>
            <a href="javascript:;" class="btn btn-secondary">Contact<svg class="bi" aria-hidden="true"> <use xlink:href="#btn-white-arrow"></use></svg></a>
            <div style="background: #131841;" class="with-dark-bg m-2 p-3">
                <a href="javascript:;" class="btn btn-primary with-gradient outline-bg-dark">View All Products</a>
            </div>
            <div style="background: #ffffff;" class="with-dark-bg m-2 p-3">
                <a href="javascript:;" class="btn btn-primary with-gradient outline-bg-white">View All Products</a>
            </div>
            <br><br>
            <a href="javascript:;" class="static-link text-14">Link 14</a><br/><br/>
            <a href="javascript:;" class="static-link text-16">Link 16</a><br/><br/>
            <a href="javascript:;" class="static-link text-18">Link 18</a><br/><br/>
            <a href="javascript:;" class="static-link text-20">Link 20</a><br/><br/>
    </div>

</section>

<script>
    document.body.className += ' ' + 'dark-head';
</script>
<?php get_footer(); ?>
