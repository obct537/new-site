<!-- This comment will put IE 6, 7 and 8 in quirks mode -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/xhtml;charset=UTF-8"/>
<title>Apache Portable Runtime: apr_table_entry_t Struct Reference</title>
<link href="tabs.css" rel="stylesheet" type="text/css"/>
<link href="search/search.css" rel="stylesheet" type="text/css"/>
<script type="text/javaScript" src="search/search.js"></script>
<link href="doxygen.css" rel="stylesheet" type="text/css"/>
</head>
<body onload='searchBox.OnSelectItem(0);'>
<!-- Generated by Doxygen 1.6.3 -->
<script type="text/javascript"><!--
var searchBox = new SearchBox("searchBox", "search",false,'Search');
--></script>
<div class="navigation" id="top">
  <div class="tabs">
    <ul>
      <li><a href="index.html"><span>Main&nbsp;Page</span></a></li>
      <li><a href="pages.html"><span>Related&nbsp;Pages</span></a></li>
      <li><a href="modules.html"><span>Modules</span></a></li>
      <li class="current"><a href="annotated.html"><span>Data&nbsp;Structures</span></a></li>
      <li><a href="files.html"><span>Files</span></a></li>
      <li>
        <div id="MSearchBox" class="MSearchBoxInactive">
        <img id="MSearchSelect" src="search/search.png"
             onmouseover="return searchBox.OnSearchSelectShow()"
             onmouseout="return searchBox.OnSearchSelectHide()"
             alt=""/>
        <input type="text" id="MSearchField" value="Search" accesskey="S"
             onfocus="searchBox.OnSearchFieldFocus(true)" 
             onblur="searchBox.OnSearchFieldFocus(false)" 
             onkeyup="searchBox.OnSearchFieldChange(event)"/>
        <a id="MSearchClose" href="javascript:searchBox.CloseResultsWindow()"><img id="MSearchCloseImg" border="0" src="search/close.png" alt=""/></a>
        </div>
      </li>
    </ul>
  </div>
  <div class="tabs">
    <ul>
      <li><a href="annotated.html"><span>Data&nbsp;Structures</span></a></li>
      <li><a href="functions.html"><span>Data&nbsp;Fields</span></a></li>
    </ul>
  </div>
</div>
<div class="contents">
<h1>apr_table_entry_t Struct Reference<br/>
<small>
[<a class="el" href="group__apr__tables.html">Table and Array Functions</a>]</small>
</h1><!-- doxytag: class="apr_table_entry_t" -->
<p><code>#include &lt;<a class="el" href="apr__tables_8h_source.html">apr_tables.h</a>&gt;</code></p>
<table border="0" cellpadding="0" cellspacing="0">
<tr><td colspan="2"><h2>Data Fields</h2></td></tr>
<tr><td class="memItemLeft" align="right" valign="top">char *&nbsp;</td><td class="memItemRight" valign="bottom"><a class="el" href="structapr__table__entry__t.html#abdccb35ea49dd95082fdce65a5a6001f">key</a></td></tr>
<tr><td class="memItemLeft" align="right" valign="top">char *&nbsp;</td><td class="memItemRight" valign="bottom"><a class="el" href="structapr__table__entry__t.html#a755371d0aa6a9487b502c34807271e6f">val</a></td></tr>
<tr><td class="memItemLeft" align="right" valign="top">apr_uint32_t&nbsp;</td><td class="memItemRight" valign="bottom"><a class="el" href="structapr__table__entry__t.html#a0c51574420b6cc7bc6c2e35710e0ad3a">key_checksum</a></td></tr>
</table>
<hr/><a name="_details"></a><h2>Detailed Description</h2>
<p>The type for each entry in a string-content table </p>
<hr/><h2>Field Documentation</h2>
<a class="anchor" id="abdccb35ea49dd95082fdce65a5a6001f"></a><!-- doxytag: member="apr_table_entry_t::key" ref="abdccb35ea49dd95082fdce65a5a6001f" args="" -->
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">char* <a class="el" href="structapr__table__entry__t.html#abdccb35ea49dd95082fdce65a5a6001f">apr_table_entry_t::key</a></td>
        </tr>
      </table>
</div>
<div class="memdoc">
<p>The key for the current table entry </p>

</div>
</div>
<a class="anchor" id="a0c51574420b6cc7bc6c2e35710e0ad3a"></a><!-- doxytag: member="apr_table_entry_t::key_checksum" ref="a0c51574420b6cc7bc6c2e35710e0ad3a" args="" -->
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">apr_uint32_t <a class="el" href="structapr__table__entry__t.html#a0c51574420b6cc7bc6c2e35710e0ad3a">apr_table_entry_t::key_checksum</a></td>
        </tr>
      </table>
</div>
<div class="memdoc">
<p>A checksum for the key, for use by the apr_table internals </p>

</div>
</div>
<a class="anchor" id="a755371d0aa6a9487b502c34807271e6f"></a><!-- doxytag: member="apr_table_entry_t::val" ref="a755371d0aa6a9487b502c34807271e6f" args="" -->
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">char* <a class="el" href="structapr__table__entry__t.html#a755371d0aa6a9487b502c34807271e6f">apr_table_entry_t::val</a></td>
        </tr>
      </table>
</div>
<div class="memdoc">
<p>The value for the current table entry </p>

</div>
</div>
<hr/>The documentation for this struct was generated from the following file:<ul>
<li><a class="el" href="apr__tables_8h_source.html">apr_tables.h</a></li>
</ul>
</div>
<!--- window showing the filter options -->
<div id="MSearchSelectWindow"
     onmouseover="return searchBox.OnSearchSelectShow()"
     onmouseout="return searchBox.OnSearchSelectHide()"
     onkeydown="return searchBox.OnSearchSelectKey(event)">
<a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(0)"><span class="SelectionMark">&nbsp;</span>All</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(1)"><span class="SelectionMark">&nbsp;</span>Data Structures</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(2)"><span class="SelectionMark">&nbsp;</span>Files</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(3)"><span class="SelectionMark">&nbsp;</span>Functions</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(4)"><span class="SelectionMark">&nbsp;</span>Variables</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(5)"><span class="SelectionMark">&nbsp;</span>Typedefs</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(6)"><span class="SelectionMark">&nbsp;</span>Enumerations</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(7)"><span class="SelectionMark">&nbsp;</span>Enumerator</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(8)"><span class="SelectionMark">&nbsp;</span>Defines</a></div>

<!-- iframe showing the search results (closed by default) -->
<div id="MSearchResultsWindow">
<iframe src="" frameborder="0" 
        name="MSearchResults" id="MSearchResults">
</iframe>
</div>

<hr class="footer"/><address style="text-align: right;"><small>Generated on Mon May 23 21:31:33 2011 for Apache Portable Runtime by&nbsp;
<a href="http://www.doxygen.org/index.html">
<img class="footer" src="doxygen.png" alt="doxygen"/></a> 1.6.3 </small></address>
</body>
</html>
