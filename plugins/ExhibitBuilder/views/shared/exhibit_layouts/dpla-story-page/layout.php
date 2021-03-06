<!-- dpla-story-page/layout.php -->
<?php if (count(dpla_get_exhibitpage_entries()) > 0): ?>
    <div class="slide-Container">
        <div class="slidegallery flexslider">
            <?php $items = dpla_get_exhibitpage_entries(); ?>
            <ul class="slides <?= count($items) == 1 ? "single-slide" : ""?>">

                <?php foreach ($items as $item): ?>
                    <?php
                        //@see class ItemMetadata, DPLAFunctions.php
                        $item_metadata = new ItemMetadata($item);
                        $metadata_opts = array('api_preferred' => true);
                    ?>
                    <li data-thumb="<?=$item['file_uri_square'] ?>"
                        data-item-id="<?=$item_metadata->get_id() ?>"
                        data-provider="<?=$item_metadata->get_provider($metadata_opts) ?>"
                        data-data-provider="<?=$item_metadata->get_data_provider() ?>"
                        data-title="<?=$item_metadata->get_title($metadata_opts) ?>"
                        class="flexslider-slide">

                        <div class="plugin-content">
                            <?php
                            $unique_id = "itemDetailsBox_".hash("md4", exhibit_builder_exhibit_item_uri($item['item']));
                            if ($media = get_plugin_hook_output('public_items_show', array('view' => get_view(), 'item' => $item['item']))) {
                                echo $media;
                            } else {
                                echo files_for_item(array(), array('class'=>'item-file'), $item['item']);
                            }
                            ?>
                        </div>

                        <div class="caption">
                            <?=$item['caption']?>
                            <span data-id="<?=$unique_id?>" class="show-item-details cboxElement"><a>More info</a></span>
                        </div>

                        <?php if (count($items) > 1): ?>
                            <div class="caption">
                                <strong>Select an item:</strong>
                            </div>
                        <?php endif; ?>

                        <div class="overlay">
                            <div id="<?=$unique_id?>">
                                <div class="inline_content">
                                    <article>
                                        <?php echo metadata_table($item); ?>
                                    </article>
                                </div>
                            </div>
                        </div> 

                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>

<?php endif; ?>


<div class="slide_bottom">
    <?php echo exhibit_builder_page_text(1); ?>
	<?php echo exhibit_builder_page_text(2); ?>

	<ul class="prevNext">
		<?php // TODO: Define first and last pages ?>
        <? if ($prevLink = dpla_link_to_previous_page('« Prev')): ?>
		    <li class="btn"><?= $prevLink ?></li>
        <? endif; ?>
        <? if ($nextLink = dpla_link_to_next_page('Next »')): ?>
		    <li class="btn"><?= $nextLink ?></li>
        <? endif; ?>
		<li><?= dpla_page_position(); ?></li>
	</ul>


</div>

<!--[if IE 8]>

<style type="text/css">
	#exhibit-item-thumbnails .exhibit-item {
		float:none !important;
	}
	#exhibit-item-thumbnails{
		white-space:nowrap;
	}
</style>

<![endif]-->

<!--[if lte IE 7]>
<style type="text/css">
	body{
		/* disable responsive behaviour (limit size to stop layout breaking) */
		min-width:	768px;
	}

	#story{
		max-width:47%;
	}

</style>
<![endif]-->