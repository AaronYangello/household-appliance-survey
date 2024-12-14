
<?php if($timeline_index) {  ?>
    <div class="timeline">
        <div class="events">
            <ol>
                <ul>
                    <li>
                        <a href="#" class="<?php if($timeline_index == 1) echo "selected"?>">Household Info</a>
                    </li>
                    <li>
                        <a href="#" class="<?php if($timeline_index == 2) echo "selected"?>">Bathrooms</a>
                    </li>
                    <li>
                        <a href="#" class="<?php if($timeline_index == 3) echo "selected"?>">Appilances</a>
                    </li>
                    <li>
                        <a href="#" class="<?php if($timeline_index == 4) echo "selected"?>">Done</a>
                    </li>
                </ul>
            </ol>
        </div>
    </div>
<?php } ?>