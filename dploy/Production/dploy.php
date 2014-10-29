<?php
/**
 * Dynatron Dploy Script
 * This script is used by the dploy system
 * This script is executed once per selected server
 * See http://dynatronsoftware.com/app/dploy
 * @copyright Dynatron Software, Inc.
 * @author Matthew Reschke <mreschke@dynatronsoftware.com>
 */

namespace App\Dploy;

class DployScript extends Dploy
{
	/**
	 * Environment Specific Configuration
	 */
	public function config($key = null, $value = null)
	{
		$config = array(
			// Deployable Servers
			'servers' => array(
				'xenstore',
			),

			// Exported SVN Folders (* = all, ! = exclude)
			'exportFolders' => array(
				'*',
				'!dploy'
			),

			// Deployable Destinations
			'destinations' => array(
				'/usr/local/lib/mrcore5/workbench/app/lbstat',
			),

			// Pre Deployment notes
			'preDeployNotes' => "
				<p>
					Check <a href='http://dynatronsoftware.com/$this->wikiID' target='_blank'>$this->appName Wiki</a> and related documents for more information.
				</p>
			",

			// Post Deployment Notes
			'postDeployNotes' => "
				This $this->appName application was just magically deployed by dploy!<br />
			",

			// Dploy Information
			'dployVersion' => '2.0',

		);
		if (isset($key) && isset($value)) $config[$key] = $value;
		if (isset($key)) { return $config[$key]; } else { return $config; }
	}


	/**
	 * Pre Deploy Function
	 */
	public function preDeploy()
	{
		foreach ($this->config('destinations') as $dest) {
			echo "Executing preDeploy() to $dest\n";

			// Prep destination
			#$this->mkdir("$dest");
			
		}
	}


	/**
	 * Deploy Function
	 */
	public function deploy()
	{
		foreach ($this->config('destinations') as $dest) {
			echo "Executing deploy() to $dest\n";

			// Rsync the main code to the destination (rsync provides an exact copy, no orphaned files on destination!)
			// source/ (recommended) will delete orphans while source/* will preserve them. Destination is relative to your defined source
			// $exclude = array("DSFramework.*", "*.vshost.*", "*.log", "*.exe.config");
			$exclude = array("dploy");
			$this->rsync(".", "$dest/", $exclude);

			// Copy over any extra files
			#$this->copy("source/*.css", "$dest/bin/");
			#$this->copy("source/ESP1Generator_*", "$dest");

		}
	}


	/**
	 * Post Deploy Function
	 */
	public function postDeploy()
	{
		foreach ($this->config('destinations') as $dest) {
			echo "Executing postDeploy() to $dest\n";

			// Merge and copy the main config file
			#$this->merge("app.config", "$this->environment/merge-config.php", "$dest/bin/ESPGenerator.exe.config");

			// Copy Environment Specific DSFramework
			#$this->copyDSFramework("prod", "$dest/bin/");

			// Write revision info file
			$this->copyRevisionInfo($dest);
			
		}
	}

}
