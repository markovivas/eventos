<?php
get_header();
if (have_posts()) : while (have_posts()) : the_post();
    $data_evento = get_post_meta(get_the_ID(), 'data_evento', true);
    $hora_evento = get_post_meta(get_the_ID(), 'hora_evento', true);
    $local_evento = get_post_meta(get_the_ID(), 'local_evento', true);
    $tipos = get_the_terms(get_the_ID(), 'tipo_evento');
    $tipo_principal = ($tipos && !is_wp_error($tipos)) ? $tipos[0]->name : '';
?>
    <article class="single-evento-container">
        <header class="evento-header">
            <div class="evento-header-inner">
                <p class="evento-eyebrow">Evento</p>
                <h1><?php the_title(); ?></h1>
                <div class="evento-meta-chips">
                    <?php if ($data_evento) : ?>
                        <span class="evento-chip"><?php echo esc_html(date_i18n('d \\d\\e F \\d\\e Y', strtotime($data_evento))); ?></span>
                    <?php endif; ?>
                    <?php if ($hora_evento) : ?>
                        <span class="evento-chip"><?php echo esc_html($hora_evento); ?></span>
                    <?php endif; ?>
                    <?php if ($tipo_principal) : ?>
                        <span class="evento-chip evento-chip-highlight"><?php echo esc_html($tipo_principal); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </header>
        <div class="evento-details">
            <ul class="evento-info-list">
                <?php if ($data_evento) : ?>
                    <li><strong>Data</strong><span><?php echo esc_html(date_i18n('d/m/Y', strtotime($data_evento))); ?></span></li>
                <?php endif; ?>
                <?php if ($hora_evento) : ?>
                    <li><strong>Hora</strong><span><?php echo esc_html($hora_evento); ?></span></li>
                <?php endif; ?>
                <?php if ($local_evento) : ?>
                    <li><strong>Local</strong><span><?php echo esc_html($local_evento); ?></span></li>
                <?php endif; ?>
                <?php if ($tipo_principal) : ?>
                    <li><strong>Tipo</strong><span class="evento-tipo"><?php echo esc_html($tipo_principal); ?></span></li>
                <?php endif; ?>
            </ul>
            <div class="evento-content-card">
                <div class="evento-content"><?php the_content(); ?></div>
            </div>
        </div>
    </article>
    <?php if (has_post_thumbnail()) : ?>
        <section class="evento-featured-image-section">
            <div class="evento-gallery-header">
                <p class="evento-gallery-eyebrow">Mídia</p>
                <h2>Galeria do evento</h2>
            </div>
            <div class="evento-featured-image-container">
                <?php the_post_thumbnail('large', array('class' => 'evento-featured-image-img', 'loading' => 'eager')); ?>
            </div>
        </section>
    <?php endif; ?>
<?php
endwhile; endif;
get_footer();
