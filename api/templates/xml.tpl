<?xml version="1.0" encoding="utf-8"?>
<post-list>
{foreach from=$row item=item}
<post>
<title>{$item.post_title}</title>
</post>
{/foreach}
</post-list>
