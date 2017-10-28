{assign var="offset" value="{($offsetY * $numColumns + $offsetX) % ($numColumns * $numRows)}"}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; utf-8"/>
	<title></title>
	<style type="text/css">
		{block name="css"}
			@page {
				margin: {$pageMarginTop}mm 0 0 {$pageMarginLeft}mm;
				padding: 0;
			}

			body {
				font-family: 'Helvetica Neue', Arial, sans-serif;
				font-size: {$fontSize};
			}

			.cell {
				display: inline-block;
				width: {$labelWidth-$labelPaddingLeft}mm;
				height: {$labelHeight}mm;
				padding: 0 0 0 {$labelPaddingLeft}mm;
				overflow: hidden;
			}

			.cell-content {
				height: {$labelHeight}mm;
			}

			.page {
				position: absolute;
				left: 0;
				top: 0;
				page-break-after: always;
				page-break-inside: avoid;
			}

			.page:last-of-type {
				/* Prevent an empty last page */
				page-break-after: auto;
			}

		{/block}
	</style>
</head>
<body>
	<div class="page">
		{* Add the item cells *}
		{for $i=0 to $offset+count($items)-1}
			{* Check for page break *}
			{if $i > 0 && i < $offset+count($items)-1 && ($i % ($numColumns * $numRows)) == 0}
				</div><div class="page">
			{/if}
			{if $i >= $offset }
				{assign var=cellItem value=$items[$i-$offset]}
			{else}
				{assign var=cellItem value=array_fill(0, 0, null)}
			{/if}
			{* Insert line break after last cell of a row but NOT if it is the first line of a new page *}
			{if $i > 0 && ($i % $numColumns) == 0 && ($i % ($numColumns * $numRows)) != 0}
				<br/>
			{/if}
			{* Render the cell *}
			<div class="cell">
				{* Use a table for vertical centering - Dompdf does not support other methods, unfortunately *}
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td class="cell-content" valign="middle">
							{if (!empty($cellItem))}
								{block name="cell-content"}{/block}
							{/if}
						</td>
					</tr>
				</table>
			</div>
		{/for}
	</div>
</body>
</html>
