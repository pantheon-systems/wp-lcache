<?php

// WP LCache
// This file needs to be symlinked or copied to wp-content/object-cache.php
// If copied, you'll need to set the WP_LCACHE_LIB_PATH constant to the LCache directory

if ( defined( 'WP_LCACHE_LIB_PATH' ) ) {
	require_once WP_LCACHE_LIB_PATH;
} else if ( file_exists( dirname( __FILE__ ) . '/lib/lcache/lcache.php' ) ) {
	require_once dirname( __FILE__ ) . '/lib/lcache/lcache.php';
}

# Users with setups where multiple installs share a common wp-config.php or $table_prefix
# can use this to guarantee uniqueness for the keys generated by this object cache
if ( ! defined( 'WP_CACHE_KEY_SALT' ) ) {
	define( 'WP_CACHE_KEY_SALT', '' );
}

if ( ! defined( 'WP_LCACHE_OBJECT_CACHE' ) ) {
	define( 'WP_LCACHE_OBJECT_CACHE', true );
}

/**
 * Adds data to the cache, if the cache key doesn't already exist.
 *
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::add()
 *
 * @param int|string $key The cache key to use for retrieval later
 * @param mixed $data The data to add to the cache store
 * @param string $group The group to add the cache to
 * @param int $expire When the cache data should be expired
 * @return bool False if cache key and group already exist, true on success
 */
function wp_cache_add( $key, $data, $group = '', $expire = 0 ) {
	global $wp_object_cache;

	return $wp_object_cache->add( $key, $data, $group, (int) $expire );
}

/**
 * Closes the cache.
 *
 * This function has ceased to do anything since WordPress 2.5. The
 * functionality was removed along with the rest of the persistent cache. This
 * does not mean that plugins can't implement this function when they need to
 * make sure that the cache is cleaned up after WordPress no longer needs it.
 *
 * @return bool Always returns True
 */
function wp_cache_close() {
	return true;
}

/**
 * Decrement numeric cache item's value
 *
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::decr()
 *
 * @param int|string $key The cache key to increment
 * @param int $offset The amount by which to decrement the item's value. Default is 1.
 * @param string $group The group the key is in.
 * @return false|int False on failure, the item's new value on success.
 */
function wp_cache_decr( $key, $offset = 1, $group = '' ) {
	global $wp_object_cache;

	return $wp_object_cache->decr( $key, $offset, $group );
}

/**
 * Removes the cache contents matching key and group.
 *
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::delete()
 *
 * @param int|string $key What the contents in the cache are called
 * @param string $group Where the cache contents are grouped
 * @return bool True on successful removal, false on failure
 */
function wp_cache_delete( $key, $group = '' ) {
	global $wp_object_cache;

	return $wp_object_cache->delete( $key, $group );
}

/**
 * Removes cache contents for a given group.
 *
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::delete_group()
 *
 * @param string $group Where the cache contents are grouped
 * @return bool True on successful removal, false on failure
 */
function wp_cache_delete_group( $group ) {
	global $wp_object_cache;
	return $wp_object_cache->delete_group( $group );
}


/**
 * Removes all cache items.
 *
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::flush()
 *
 * @return bool False on failure, true on success
 */
function wp_cache_flush() {
	global $wp_object_cache;

	return $wp_object_cache->flush();
}

/**
 * Retrieves the cache contents from the cache by key and group.
 *
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::get()
 *
 * @param int|string $key What the contents in the cache are called
 * @param string $group Where the cache contents are grouped
 * @param bool $force Whether to force an update of the local cache from the persistent cache (default is false)
 * @param &bool $found Whether key was found in the cache. Disambiguates a return of false, a storable value.
 * @return bool|mixed False on failure to retrieve contents or the cache
 *		contents on success
 */
function wp_cache_get( $key, $group = '', $force = false, &$found = null ) {
	global $wp_object_cache;

	return $wp_object_cache->get( $key, $group, $force, $found );
}

/**
 * Increment numeric cache item's value
 *
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::incr()
 *
 * @param int|string $key The cache key to increment
 * @param int $offset The amount by which to increment the item's value. Default is 1.
 * @param string $group The group the key is in.
 * @return false|int False on failure, the item's new value on success.
 */
function wp_cache_incr( $key, $offset = 1, $group = '' ) {
	global $wp_object_cache;

	return $wp_object_cache->incr( $key, $offset, $group );
}

/**
 * Sets up Object Cache Global and assigns it.
 *
 * @global WP_Object_Cache $wp_object_cache WordPress Object Cache
 */
function wp_cache_init() {
	$GLOBALS['wp_object_cache'] = new WP_Object_Cache();
}

/**
 * Replaces the contents of the cache with new data.
 *
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::replace()
 *
 * @param int|string $key What to call the contents in the cache
 * @param mixed $data The contents to store in the cache
 * @param string $group Where to group the cache contents
 * @param int $expire When to expire the cache contents
 * @return bool False if not exists, true if contents were replaced
 */
function wp_cache_replace( $key, $data, $group = '', $expire = 0 ) {
	global $wp_object_cache;

	return $wp_object_cache->replace( $key, $data, $group, (int) $expire );
}

/**
 * Saves the data to the cache.
 *
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::set()
 *
 * @param int|string $key What to call the contents in the cache
 * @param mixed $data The contents to store in the cache
 * @param string $group Where to group the cache contents
 * @param int $expire When to expire the cache contents
 * @return bool False on failure, true on success
 */
function wp_cache_set( $key, $data, $group = '', $expire = 0 ) {
	global $wp_object_cache;

	return $wp_object_cache->set( $key, $data, $group, (int) $expire );
}

/**
 * Switch the interal blog id.
 *
 * This changes the blog id used to create keys in blog specific groups.
 *
 * @param int $blog_id Blog ID
 */
function wp_cache_switch_to_blog( $blog_id ) {
	global $wp_object_cache;

	return $wp_object_cache->switch_to_blog( $blog_id );
}

/**
 * Adds a group or set of groups to the list of global groups.
 *
 * @param string|array $groups A group or an array of groups to add
 */
function wp_cache_add_global_groups( $groups ) {
	global $wp_object_cache;

	return $wp_object_cache->add_global_groups( $groups );
}

/**
 * Adds a group or set of groups to the list of non-persistent groups.
 *
 * @param string|array $groups A group or an array of groups to add
 */
function wp_cache_add_non_persistent_groups( $groups ) {
	global $wp_object_cache;

	$wp_object_cache->add_non_persistent_groups( $groups );
}

/**
 * Reset internal cache keys and structures. If the cache backend uses global
 * blog or site IDs as part of its cache keys, this function instructs the
 * backend to reset those keys and perform any cleanup since blog or site IDs
 * have changed since cache init.
 *
 * This function is deprecated. Use wp_cache_switch_to_blog() instead of this
 * function when preparing the cache for a blog switch. For clearing the cache
 * during unit tests, consider using wp_cache_init(). wp_cache_init() is not
 * recommended outside of unit tests as the performance penality for using it is
 * high.
 *
 * @deprecated 3.5.0
 */
function wp_cache_reset() {
	_deprecated_function( __FUNCTION__, '3.5' );

	global $wp_object_cache;

	return $wp_object_cache->reset();
}

/**
 * WordPress Object Cache
 *
 * The WordPress Object Cache is used to save on trips to the database. The
 * Object Cache stores all of the cache data to memory and makes the cache
 * contents available by using a key, which is used to name and later retrieve
 * the cache contents.
 *
 * The Object Cache can be replaced by other caching mechanisms by placing files
 * in the wp-content folder which is looked at in wp-settings. If that file
 * exists, then this file will not be included.
 */
class WP_Object_Cache {

	/**
	 * Holds the cached objects
	 *
	 * @var array
	 * @access private
	 */
	var $cache = array();

	/**
	 * The amount of times the cache data was already stored in the cache.
	 *
	 * @access private
	 * @var int
	 */
	var $cache_hits = 0;

	/**
	 * Amount of times the cache did not have the request in cache
	 *
	 * @var int
	 * @access public
	 */
	var $cache_misses = 0;

	/**
	 * A count of calls made to LCache
	 *
	 * @access private
	 * @var int
	 */
	var $lcache_calls = array();

	/**
	 * List of global groups
	 *
	 * @var array
	 * @access protected
	 */
	var $global_groups = array();

	/**
	 * List of non-persistent groups
	 *
	 * @var array
	 * @access protected
	 */
	var $non_persistent_groups = array();

	/**
	 * The blog prefix to prepend to keys in non-global groups.
	 *
	 * @var int
	 * @access private
	 */
	var $blog_prefix;

	/**
	 * LCache instance to interact with
	 *
	 * @var bool
	 * @access private
	 */
	var $lcache = null;

	/**
	 * The last triggered error
	 */
	var $last_triggered_error = '';

	/**
	 * Adds data to the cache if it doesn't already exist.
	 *
	 * @uses WP_Object_Cache::_exists Checks to see if the cache already has data.
	 * @uses WP_Object_Cache::set Sets the data after the checking the cache
	 *		contents existence.
	 *
	 * @param int|string $key What to call the contents in the cache
	 * @param mixed $data The contents to store in the cache
	 * @param string $group Where to group the cache contents
	 * @param int $expire When to expire the cache contents
	 * @return bool False if cache key and group already exist, true on success
	 */
	public function add( $key, $data, $group = 'default', $expire = 0 ) {

		if ( empty( $group ) ) {
			$group = 'default';
		}

		if ( function_exists( 'wp_suspend_cache_addition' ) && wp_suspend_cache_addition() ) {
			return false;
		}

		if ( $this->_exists( $key, $group ) ) {
			return false;
		}

		return $this->set( $key, $data, $group, (int) $expire );
	}

	/**
	 * Sets the list of global groups.
	 *
	 * @param array $groups List of groups that are global.
	 */
	public function add_global_groups( $groups ) {
		$groups = (array) $groups;

		$groups = array_fill_keys( $groups, true );
		$this->global_groups = array_merge( $this->global_groups, $groups );
	}

	/**
	 * Sets the list of non-persistent groups.
	 *
	 * @param array $groups List of groups that are non-persistent.
	 */
	public function add_non_persistent_groups( $groups ) {
		$groups = (array) $groups;

		$groups = array_fill_keys( $groups, true );
		$this->non_persistent_groups = array_merge( $this->non_persistent_groups, $groups );
	}

	/**
	 * Decrement numeric cache item's value
	 *
	 * @param int|string $key The cache key to increment
	 * @param int $offset The amount by which to decrement the item's value. Default is 1.
	 * @param string $group The group the key is in.
	 * @return false|int False on failure, the item's new value on success.
	 */
	public function decr( $key, $offset = 1, $group = 'default' ) {

		if ( empty( $group ) ) {
			$group = 'default';
		}

		// The key needs to exist in order to be decremented
		if ( ! $this->_exists( $key, $group ) ) {
			return false;
		}

		$offset = (int) $offset;

		# If this isn't a persistant group, we have to sort this out ourselves, grumble grumble
		if ( ! $this->_should_persist( $group ) ) {
			$existing = $this->_get_internal( $key, $group );
			if ( empty( $existing ) || ! is_numeric( $existing ) ) {
				$existing = 0;
			} else {
				$existing -= $offset;
			}
			if ( $existing < 0 ) {
				$existing = 0;
			}
			$this->_set_internal( $key, $group, $existing );
			return $existing;
		}

		$id = $this->_key( $key, $group );
		$result = $this->_call_lcache( 'decr', $id, $offset );

		if ( is_int( $result ) ) {
			$this->_set_internal( $key, $group, $result );
		}
		return $result;
	}

	/**
	 * Remove the contents of the cache key in the group
	 *
	 * If the cache key does not exist in the group and $force parameter is set
	 * to false, then nothing will happen. The $force parameter is set to false
	 * by default.
	 *
	 * @param int|string $key What the contents in the cache are called
	 * @param string $group Where the cache contents are grouped
	 * @param bool $force Optional. Whether to force the unsetting of the cache
	 *		key in the group
	 * @return bool False if the contents weren't deleted and true on success
	 */
	public function delete( $key, $group = 'default', $force = false ) {

		if ( empty( $group ) ) {
			$group = 'default';
		}

		if ( ! $force && ! $this->_exists( $key, $group ) ) {
			return false;
		}

		if ( $this->_should_persist( $group ) ) {
			$id = $this->_key( $key, $group );
			$result = $this->_call_lcache( 'delete', $id );
			if ( ! $result ) {
				return false;
			}
		}

		$this->_unset_internal( $key, $group );
		return true;
	}

	/**
	 * Clears the object cache of all data.
	 *
	 * By default, this will flush the session cache as well as LCache, but we
	 * can leave the LCache cache intact if we want. This is helpful when, for
	 * instance, you're running a batch process and want to clear the session
	 * store to reduce the memory footprint, but you don't want to have to
	 * re-fetch all the values from the database.
	 *
	 * @param  bool $lcache Should we flush LCache as well as the session cache?
	 * @return bool Always returns true
	 */
	public function flush( $lcache = true ) {
		$this->cache = array();
		if ( $lcache ) {
			$this->_call_lcache( 'delete' );
		}

		return true;
	}

	/**
	 * Retrieves the cache contents, if it exists
	 *
	 * The contents will be first attempted to be retrieved by searching by the
	 * key in the cache group. If the cache is hit (success) then the contents
	 * are returned.
	 *
	 * On failure, the number of cache misses will be incremented.
	 *
	 * @param int|string $key What the contents in the cache are called
	 * @param string $group Where the cache contents are grouped
	 * @param string $force Whether to force a refetch rather than relying on the local cache (default is false)
	 * @param bool $found Optional. Whether the key was found in the cache. Disambiguates a return of false, a storable value. Passed by reference. Default null.
	 * @return bool|mixed False on failure to retrieve contents or the cache
	 *		contents on success
	 */
	public function get( $key, $group = 'default', $force = false, &$found = null ) {

		if ( empty( $group ) ) {
			$group = 'default';
		}

		// Key is set internally, so we can use this value
		if ( $this->_isset_internal( $key, $group ) && ! $force ) {
			$this->cache_hits += 1;
			$found = true;
			return $this->_get_internal( $key, $group );
		}

		// Not a persistent group, so don't try LCache if the value doesn't exist
		// internally
		if ( ! $this->_should_persist( $group ) ) {
			$this->cache_misses += 1;
			$found = false;
			return false;
		}

		$id = $this->_key( $key, $group );
		$value = $this->_call_lcache( 'get', $id );

		// LCache returns `false` when the key doesn't exist
		if ( null === $value ) {
			$this->cache_misses += 1;
			$found = false;
			return false;
		}

		// All non-numeric values are serialized
		if ( ! is_numeric( $value ) ) {
			$value = unserialize( $value );
		}

		$this->_set_internal( $key, $group, $value );
		$this->cache_hits += 1;
		$found = true;
		return $value;
	}

	/**
	 * Increment numeric cache item's value
	 *
	 * @param int|string $key The cache key to increment
	 * @param int $offset The amount by which to increment the item's value. Default is 1.
	 * @param string $group The group the key is in.
	 * @return false|int False on failure, the item's new value on success.
	 */
	public function incr( $key, $offset = 1, $group = 'default' ) {

		if ( empty( $group ) ) {
			$group = 'default';
		}

		// The key needs to exist in order to be incremented
		if ( ! $this->_exists( $key, $group ) ) {
			return false;
		}

		$offset = (int) $offset;

		# If this isn't a persistant group, we have to sort this out ourselves, grumble grumble
		if ( ! $this->_should_persist( $group ) ) {
			$existing = $this->_get_internal( $key, $group );
			if ( empty( $existing ) || ! is_numeric( $existing ) ) {
				$existing = 1;
			} else {
				$existing += $offset;
			}
			if ( $existing < 0 ) {
				$existing = 0;
			}
			$this->_set_internal( $key, $group, $existing );
			return $existing;
		}

		$id = $this->_key( $key, $group );
		$result = $this->_call_lcache( 'incr', $id, $offset );

		if ( is_int( $result ) ) {
			$this->_set_internal( $key, $group, $result );
		}
		return $result;
	}

	/**
	 * Replace the contents in the cache, if contents already exist
	 * @see WP_Object_Cache::set()
	 *
	 * @param int|string $key What to call the contents in the cache
	 * @param mixed $data The contents to store in the cache
	 * @param string $group Where to group the cache contents
	 * @param int $expire When to expire the cache contents
	 * @return bool False if not exists, true if contents were replaced
	 */
	public function replace( $key, $data, $group = 'default', $expire = 0 ) {

		if ( empty( $group ) ) {
			$group = 'default';
		}

		if ( ! $this->_exists( $key, $group ) ) {
			return false;
		}

		return $this->set( $key, $data, $group, (int) $expire );
	}

	/**
	 * Reset keys
	 *
	 * @deprecated 3.5.0
	 */
	public function reset() {
		_deprecated_function( __FUNCTION__, '3.5', 'switch_to_blog()' );
	}

	/**
	 * Sets the data contents into the cache
	 *
	 * The cache contents is grouped by the $group parameter followed by the
	 * $key. This allows for duplicate ids in unique groups. Therefore, naming of
	 * the group should be used with care and should follow normal function
	 * naming guidelines outside of core WordPress usage.
	 *
	 * The $expire parameter is not used, because the cache will automatically
	 * expire for each time a page is accessed and PHP finishes. The method is
	 * more for cache plugins which use files.
	 *
	 * @param int|string $key What to call the contents in the cache
	 * @param mixed $data The contents to store in the cache
	 * @param string $group Where to group the cache contents
	 * @param int $expire TTL for the data, in seconds
	 * @return bool Always returns true
	 */
	public function set( $key, $data, $group = 'default', $expire = 0 ) {

		if ( empty( $group ) ) {
			$group = 'default';
		}

		if ( is_object( $data ) ) {
			$data = clone $data;
		}

		$this->_set_internal( $key, $group, $data );

		if ( ! $this->_should_persist( $group ) ) {
			return true;
		}

		# If this is an integer, store it as such. Otherwise, serialize it.
		if ( ! is_numeric( $data ) || intval( $data ) !== $data ) {
			$data = serialize( $data );
		}

		$id = $this->_key( $key, $group );
		$this->_call_lcache( 'set', $id, $data, $expire );
		return true;
	}

	/**
	 * Echoes the stats of the caching.
	 *
	 * Gives the cache hits, and cache misses. Also prints every cached group,
	 * key and the data.
	 */
	public function stats() {
		$total_lcache_calls = 0;
		foreach ( $this->lcache_calls as $method => $calls ) {
			$total_lcache_calls += $calls;
		}
		$out = array();
		$out[] = '<p>';
		$out[] = '<strong>Cache Hits:</strong>' . (int) $this->cache_hits . '<br />';
		$out[] = '<strong>Cache Misses:</strong>' . (int) $this->cache_misses . '<br />';
		$out[] = '<strong>LCache Calls:</strong>' . (int) $total_lcache_calls . ':<br />';
		foreach ( $this->lcache_calls as $method => $calls ) {
			$out[] = ' - ' . esc_html( $method ) . ': ' . (int) $calls . '<br />';
		}
		$out[] = '</p>';
		$out[] = '<ul>';
		foreach ( $this->cache as $group => $cache ) {
			$out[] = '<li><strong>Group:</strong> ' . esc_html( $group ) . ' - ( ' . number_format( strlen( serialize( $cache ) ) / 1024, 2 ) . 'k )</li>';
		}
		$out[] = '</ul>';
		// @codingStandardsIgnoreStart
		echo implode( PHP_EOL, $out );
		// @codingStandardsIgnoreEnd
	}

	/**
	 * Switch the interal blog id.
	 *
	 * This changes the blog id used to create keys in blog specific groups.
	 *
	 * @param int $blog_id Blog ID
	 */
	public function switch_to_blog( $blog_id ) {
		$blog_id = (int) $blog_id;
		$this->blog_prefix = $this->multisite ? $blog_id . ':' : '';
	}

	/**
	 * Utility function to determine whether a key exists in the cache.
	 *
	 * @access protected
	 */
	protected function _exists( $key, $group ) {
		if ( $this->_isset_internal( $key, $group ) ) {
			return true;
		}

		if ( ! $this->_should_persist( $group ) ) {
			return false;
		}

		$id = $this->_key( $key, $group );
		return $this->_call_lcache( 'exists', $id );
	}

	/**
	 * Check whether there's a value in the internal object cache.
	 *
	 * @param string $key
	 * @param string $group
	 * @return boolean
	 */
	protected function _isset_internal( $key, $group ) {
		$key = $this->_key( $key, $group );
		return isset( $this->cache[ $key ] );
	}

	/**
	 * Get a value from the internal object cache
	 *
	 * @param string $key
	 * @param string $group
	 * @return mixed
	 */
	protected function _get_internal( $key, $group ) {
		$value = null;
		$key = $this->_key( $key, $group );
		if ( isset( $this->cache[ $key ] ) ) {
			$value = $this->cache[ $key ];
		}
		if ( is_object( $value ) ) {
			return clone $value;
		}
		return $value;
	}

	/**
	 * Set a value to the internal object cache
	 *
	 * @param string $key
	 * @param string $group
	 * @param mixed $value
	 */
	protected function _set_internal( $key, $group, $value ) {
		// LCache expects null to be an empty string
		if ( is_null( $value ) ) {
			$value = '';
		}
		$key = $this->_key( $key, $group );
		$this->cache[ $key ] = $value;
	}

	/**
	 * Unset a value from the internal object cache
	 *
	 * @param string $key
	 * @param string $group
	 */
	protected function _unset_internal( $key, $group ) {
		$key = $this->_key( $key, $group );
		if ( isset( $this->cache[ $key ] ) ) {
			unset( $this->cache[ $key ] );
		}
	}

	/**
	 * Utility function to generate the APCu key for a given key and group.
	 *
	 * @param  string $key   The cache key.
	 * @param  string $group The cache group.
	 * @return string        A properly prefixed APCu cache key.
	 */
	protected function _key( $key = '', $group = 'default' ) {
		if ( empty( $group ) ) {
			$group = 'default';
		}

		if ( ! empty( $this->global_groups[ $group ] ) ) {
			$prefix = $this->global_prefix;
		} else {
			$prefix = $this->blog_prefix;
		}

		return preg_replace( '/\s+/', '', WP_CACHE_KEY_SALT . "$prefix$group:$key" );
	}

	/**
	 * Does this group use persistent storage?
	 *
	 * @param  string $group Cache group.
	 * @return bool        true if the group is persistent, false if not.
	 */
	protected function _should_persist( $group ) {
		return empty( $this->non_persistent_groups[ $group ] );
	}

	/**
	 * Wrapper method for calls to LCache, which fails gracefully when LCache is unavailable
	 *
	 * @param string $method
	 * @param mixed $args
	 * @return mixed
	 */
	protected function _call_lcache( $method ) {
		global $wpdb;

		$arguments = func_get_args();
		array_shift( $arguments ); // ignore $method

		if ( $this->is_lcache_available() ) {
			if ( ! isset( $this->lcache_calls[ $method ] ) ) {
				$this->lcache_calls[ $method ] = 0;
			}
			$this->lcache_calls[ $method ]++;
			// Some LCache methods don't exist directly, so we need to mock them
			switch ( $method ) {
				case 'exists':
					$retval = call_user_func_array( array( $this->lcache, 'get' ), $arguments );
					$retval = ! is_null( $retval );
					break;

				case 'incr':
				case 'decr':
					$retval = $this->lcache->get( $arguments[0] );
					if ( 'incr' === $method ) {
						$retval += $arguments[1];
					} else if ( 'decr' === $method ) {
						$retval -= $arguments[1];
					}
					if ( $retval < 0 ) {
						$retval = 0;
					}
					$this->lcache->set( $arguments[0], $retval );
					break;

				default:
					$retval = call_user_func_array( array( $this->lcache, $method ), $arguments );
					break;
			}
			return $retval;
		}

		// Mock expected behavior from APCu for these methods
		switch ( $method ) {
			case 'incr':
				$val = $this->cache[ $arguments[0] ] + $arguments[1];
				if ( $val < 0 ) {
					$val = 0;
				}
				return $val;
			case 'decr':
				$val = $this->cache[ $arguments[0] ] - $arguments[1];
				if ( $val < 0 ) {
					$val = 0;
				}
				return $val;
			case 'delete':
				return true;
			case 'exists':
			case 'get':
				return null;
		}

	}

	/**
	 * Admin UI to let the end user know that LCache isn't available
	 */
	public function wp_action_admin_notices_warn_missing_lcache() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		echo '<div class="message error"><p>Warning! LCache library or APCu is unavailable, which is required by WP LCache object cache.</p></div>';
	}

	/**
	 * Whether or not LCache is available
	 *
	 * @return bool
	 */
	public function is_lcache_available() {
		return ! is_null( $this->lcache );
	}

	/**
	 * Sets up object properties; PHP 5 style constructor
	 *
	 * @return null|WP_Object_Cache If cache is disabled, returns null.
	 */
	public function __construct() {
		global $blog_id, $table_prefix;

		$this->multisite = is_multisite();
		$this->blog_prefix = $this->multisite ? $blog_id . ':' : '';
		
		// apcu_sma_info() triggers a warning when APCu is disabled
		if ( function_exists( 'apcu_sma_info' ) && @apcu_sma_info() && class_exists( 'LCacheNullL1' ) ) {
			$l1 = new LCacheNullL1();
			if ( php_sapi_name() !== 'cli' || 'on' === ini_get( 'apc.enable_cli' ) ) {
				$l1 = new LCacheAPCuL1();
			}
			$port = null;
			$socket = null;
			$host = DB_HOST;
			$port_or_socket = strstr( $host, ':' );
			if ( ! empty( $port_or_socket ) ) {
				$host = substr( $host, 0, strpos( $host, ':' ) );
				$port_or_socket = substr( $port_or_socket, 1 );
				if ( 0 !== strpos( $port_or_socket, '/' ) ) {
					$port = intval( $port_or_socket );
					$maybe_socket = strstr( $port_or_socket, ':' );
					if ( ! empty( $maybe_socket ) ) {
						$socket = substr( $maybe_socket, 1 );
					}
				} else {
					$socket = $port_or_socket;
				}
			}

			if ( defined( 'WP_LCACHE_RUNNING_TESTS' ) && WP_LCACHE_RUNNING_TESTS ) {
				wp_lcache_initialize_database_schema();
			}

			$dsn = 'mysql:host='. DB_HOST. ';port='. $port .';dbname='. DB_NAME;
			$options = array( PDO::ATTR_TIMEOUT => 2, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="ANSI_QUOTES"' );
			$dbh = new PDO( $dsn, DB_USER, DB_PASSWORD, $options );
			$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$l2 = new LCacheDatabaseL2( $dbh );
			$this->lcache = new LCacheIntegrated( $l1, $l2 );
			$this->lcache->synchronize();
		}

		if ( ! $this->is_lcache_available() && function_exists( 'add_action' ) ) {
			add_action( 'admin_notices', array( $this, 'wp_action_admin_notices_warn_missing_lcache' ) );
		}

		$this->global_prefix = ( $this->multisite || defined( 'CUSTOM_USER_TABLE' ) && defined( 'CUSTOM_USER_META_TABLE' ) ) ? '' : $table_prefix;

		/**
		 * @todo This should be moved to the PHP4 style constructor, PHP5
		 * already calls __destruct()
		 */
		register_shutdown_function( array( $this, '__destruct' ) );
	}

	/**
	 * Will save the object cache before object is completely destroyed.
	 *
	 * Called upon object destruction, which should be when PHP ends.
	 *
	 * @return bool True value. Won't be used by PHP
	 */
	public function __destruct() {
		return true;
	}
}
