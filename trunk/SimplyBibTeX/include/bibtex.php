<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module			: bibtex parser class
// Description		: generates a 2d array of all bibtex items 
// Author			: Hartmut Seichter
// Acknowledgement	: Zhe Wu at Univ. of Rochester, http://qcite.com
// License			: GPL
// CVS				: $Id$
// ---------------------------------------------------------------------------

require_once('template.php');


class BibTeX 
{

	var $count;
	var $items;
	var $types;
	var $fid;

	var $pagefrom, $pageto;

	function BibTeX($file) {
		$this->fid=fopen ($file,'r');
		if (!$this->fid) 
		{	
			return null;
		}		
	}
	

function parse()
{
	if (!$this->fid) return NULL;
	
	$this->count=-1;

	for ($lineindex=0;$lineindex<800;$lineindex++)
	{
		if (feof($this->fid)){break;}
		$line=trim(fgets($this->fid,10240));

		$line=str_replace("'","`",$line);
		$seg=str_replace("\"","`",$line);
		$ps=strpos($seg,'=');
		$segtest=strtolower($seg);
		if (strpos($segtest,'@string')!==false) {continue;}
		if (strpos($seg,'%%')!==false) {continue;}
        
		if ($seg[0]=='@')
        {
                $this->count++;
                $ps=strpos($seg,'@');
                $pe=strpos($seg,'{');
                $this->types[$this->count]=trim(substr($seg, 1,$pe-1));
                $fieldcount=-1; // -------------------------reset field count
        } // #of item increase
        elseif ($ps!==false ) // one field begins
        {
                $ps=strpos($seg,'=');
                $fieldcount++;
				$this->items[raw][$this->count] .= $seg; 
                $var[$fieldcount]=strtolower(trim(substr($seg,0,$ps)));
                if ($var[$fieldcount]=='pages')
                {
                        $ps=strpos($seg,'=');
                        $pm=strpos($seg,'--');
                        $pe=strpos($seg,'},');

                        $pagefrom[$this->count] = substr($seg,$ps,$pm-$ps);
						$pageto[$this->count]=substr($seg,$pm,$pe-$pm);

						$bp=str_replace('=','',$pagefrom[$this->count]); $bp=str_replace('{','',$bp);$bp=str_replace('}','',$bp);$bp=trim(str_replace('-','',$bp));
        				$ep=str_replace('=','',$pageto[$this->count]); $bp=str_replace('{','',$bp);$bp=str_replace('}','',$bp);;$ep=trim(str_replace('-','',$ep));
                }
                $pe=strpos($seg,'},');
                if ($pe ===false)
                { $value[$fieldcount]=strstr($seg,'='); }
                else
				{ $value[$fieldcount]=substr($seg,$ps,$pe);}
			}
			else
			{
				$pe=strpos($seg,'},');

				if ($pe ===false)
					{ $value[$fieldcount].=' '.strstr($seg,' '); }
				else
					{ $value[$fieldcount].=' '.substr($seg,$ps,$pe);}
			}

			$v=$value[$fieldcount];
			$v=str_replace('=','',$v);
			$v=str_replace('{','',$v);
			$v=str_replace('}','',$v);
			$v=str_replace(',',' ',$v);
			$v=str_replace('\'',' ',$v);
			$v=str_replace('\"',' ',$v);
			$v=trim($v);
			
        	$this->items[$var[$fieldcount]][$this->count]=$v;
        }
	} // parse


	function render_all($template)
	{
		for ($i = 0; $i <= $this->count; $i++)
		{
			// fill the template engine with the respective values
			$template->set("type",$this->types[$i]);
			
			if ($i % 2) 
				$template->set("oddeven","odd");
			else
				$template->set("oddeven","even");

			$template->set("number",$i);

			$template->set("journal",$this->items[journal][$i].$this->items[booktitle][$i]);
			$template->set("author",$this->items[author][$i]);
			$template->set("title",$this->items[title][$i]);
			$template->set("volume",$this->items[volume][$i].$this->items[chapter][$i]);
			$template->set("url",$this->items[url][$i]);
			$template->set("note",$this->items[note][$i]);
			$template->set("abstract",$this->items[abstract][$i]);
			$template->set("year",$this->items[year][$i]);
			$template->set("group",$this->items[folder][$i]);
			$template->set("publisher",$this->items[publisher][$i]);
			$template->set("page-start",$this->items[page-start][$i]);
			$template->set("page-end",$this->items[page-end][$i]);		
			$template->set("pages",$this->items[pages][$i]);
			$template->set("address",$this->items[address][$i]);
			$template->set("raw",$this->items[raw][$i]);

			$template->make();

			$output .= $template->output;
		}
		return $output;
	}

	function render_filter($template,$filter)
	{
		for ($i = 0; $i <= $this->count; $i++)
		{
			// fill the template engine with the respective values
			$template->set("type",$this->types[$i]);
			
			if ($i % 2) 
				$template->set("oddeven","odd");
			else
				$template->set("oddeven","even");

			$template->set("number",$i);

			$template->set("journal",$this->items[journal][$i].$this->items[booktitle][$i]);
			$template->set("author",$this->items[author][$i]);
			$template->set("title",$this->items[title][$i]);
			$template->set("volume",$this->items[volume][$i].$this->items[chapter][$i]);
			$template->set("url",$this->items[url][$i]);
			$template->set("note",$this->items[note][$i]);
			$template->set("abstract",$this->items[abstract][$i]);
			$template->set("year",$this->items[year][$i]);
			$template->set("group",$this->items[folder][$i]);
			$template->set("publisher",$this->items[publisher][$i]);
			$template->set("page-start",$this->items[page-start][$i]);
			$template->set("page-end",$this->items[page-end][$i]);		
			$template->set("pages",$this->items[pages][$i]);
			$template->set("address",$this->items[address][$i]);
			$template->set("raw",$this->items[raw][$i]);

			$template->make();

			$output .= $template->output;
		}
		return $output;
	}
}
?>
