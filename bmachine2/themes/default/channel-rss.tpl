<?xml version="1.0"?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
  <channel>
    <title>{$channel.title}</title>
    <link>{$siteDomain}{$baseUri}channel/{$channel.title|urlencode}</link>
    <description>{$channel.description}</description>
    <generator>Broadcast Machine</generator>
	
	{foreach from=$channel.videos item=video}
	<item>
		<title>{$video.title}</title>
		<link>{$siteDomain}{$baseUri}video/{$video.title|urlencode}</link>
		<description>{$video.description}</description>
		<media:content 
			url="{$video.file_url}" 
			fileSize="{$video.size}" 
			type="{$video.mime}"
			medium="video"
			duration="{$video.runtime}" />
		{if $video.adult}
		<media:rating scheme="urn:simple">adult</media:rating>
		{/if}
		<media:title type="plain">{$video.title}</media:title>
		<media:description type="plain">{$video.description}</media:description>
		<media:keywords>
		{$firstTime = true}
		{foreach from=$video.tags item=tag}
			{if $firstTime}
		{$tag}
			{else}
		, {$tag}
			{/if}
		{/foreach}
		</media:keywords>
		<media:thumbnail url="{$video.icon_url}" width="300" />
		<pubDate>{$video.release_date|date_format:"%a, %d %b %Y %T"} EST</pubDate>
		<guid>{$siteDomain}{$baseUri}video/{$video.title|urlencode}</guid>
	</item>
	{/foreach}
  </channel>
</rss>
