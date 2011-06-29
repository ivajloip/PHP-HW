{extends file="base.tpl"}
    {block name=body}
        <div>
            <h1>
                <span class="{$article_title_class}">
                    {$article.article_title}
                </span>
            </h1>
        </div>
        <div>
            <pre class="{$article_class}">{$article.article}</pre>
        </div>

        <div>
            {$author_msg} {$article.publisher_name} 
            {$published_date_mgs} {$article.published_date}
            {$liked_msg}: {$article.liked_count} {$disliked_msg}: {$article.disliked_count}
        </div>

        <div id="like_dislike_buttons">

            <form id="like_form" action="like.php" method="post">
                <input type="hidden" value="{$article._id}" name="articleId"/>
                <input type="hidden" value="article" name="type"/>
                <input type="submit" value="{$liked_msg}" name="like">
                <input type="submit" value="{$disliked_msg}" name="dislike">
            </form>
        </div>


        <div>
            <form id="{$form_id}" action="{$action}" method="post" class="{$form_class}">
                <span class="{$block}">
                   <label class="{$comment_label_class}" for"comment">{$comment_label_msg}:</label>
                   <textarea class="{$comment_text_class}" id="comment" name="comment" cols="40" rows="5" ></textarea>
                </span>
                <input class="{$button}" type="submit" name="submit" value="{$submit_msg}" id="submit" />
            </form>
        </div>

<!-- comments -->
        <table class="{$table_class}">
            <tr class="{$tr_header_class}">
                <th class="{$th_class}">
                    {$table_header_msg}
                </th>
            </tr>
            {foreach from=$article.comments item=comment}
            {strip}
            <tr class="{$tr_class}">
                <td class="{$td_class}">
                    <div class="{$comment_content}">
                        <pre>
                            {$comment.comment}
                        </pre>
                    </div>
                    <div class="{$comment_info}">
                        {$author_msg} {$comment.publisher_name} 
                        {$published_date_mgs} {$comment.published_date}
                        {$liked_msg} {$comment.liked_count} 
                        {$disliked_msg} {$comment.disliked_count}
                        <form id="like_form" action="like.php" method="post">
                            <input type="hidden" value="{$comment._id}" name="commentId"/>
                            <input type="hidden" value="{$article._id}" name="articleId"/>
                            <input type="hidden" value="comment" name="type"/>
                            <input type="submit" value="{$liked_msg}" name="like">
                            <input type="submit" value="{$disliked_msg}" name="dislike">
                        </form>
                    </div>
                </td>
            </tr>
            {/strip}
            {/foreach}
        </table>
<!-- end of comments -->

    {/block}
