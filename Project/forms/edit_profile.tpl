{extends file="register_form.tpl"}
            {block name=user_info}

		    <span class="block">
		        <label for="display_name" class="{$label_class}">{$display_name_msg}:</label>
		        <input type="text" name="display_name" value="{$display_name_value}" id="display_name" class="{$input_class}" />
		    </span>
            
            <span class="block">
		        <label for="male" class="{$label_class}">{$male_msg}</label>
		        <input type="radio" name="sex" value="male" id="male" class="{$input_class}" 
                    {$male_checked} />
		    </span>

		    <span class="block">
		        <label for="female" class="{$label_class}">{$female_msg}</label>
		        <input type="radio" name="sex" value="female" id="female" class="{$input_class}" 
                    {$female_checked} />
		    </span>

		    <span class="block">
                <input type="hidden" name="MAX_FILE_SIZE" value="{$max_file_size}" /> <!-- bytes -->
                <label for="avatar">{$avatar_msg}</label>
                <input id="avatar" type="file" name="avatar"/> 
		    </span>

            {if $admin_view eq true}
		    <span class="block">
		        <label for="is_admin" class="{$label_class}">{$is_admin_msg}</label>
		        <input type="checkbox" name="is_admin" value="true" id="is_admin" class="{$input_class}" 
                    {$is_admin_checked} />
		    </span>

		    <span class="block">
		        <label for="is_moderator" class="{$label_class}">{$is_moderator_msg}</label>
		        <input type="checkbox" name="is_moderator" value="true" id="is_moderator" class="{$input_class}" 
                    {$is_moderator_checked} />
		    </span>

            {/if}
		    <span class="block">
		        <label for="is_active" class="{$label_class}">{$is_active_msg}</label>
		        <input type="checkbox" name="is_active" value="true" id="is_active" class="{$input_class}" 
                    {$is_active_checked} />
		    </span>

            {/block}