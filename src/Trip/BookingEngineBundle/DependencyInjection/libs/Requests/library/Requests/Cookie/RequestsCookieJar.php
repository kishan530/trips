<?php
namespace Trip\BookingEngineBundle\DependencyInjection\libs\Requests\library\Requests\Cookie;
use Trip\BookingEngineBundle\DependencyInjection\libs\Requests\library\Requests\RequestsCookie;
use Trip\BookingEngineBundle\DependencyInjection\libs\Requests\library\Requests\Hooker;
use Trip\BookingEngineBundle\DependencyInjection\libs\Requests\library\Requests\RequestsResponse;
/**
 * Cookie holder object
 *
 * @package Requests
 * @subpackage Cookies
 */

/**
 * Cookie holder object
 *
 * @package Requests
 * @subpackage Cookies
 */
class RequestsCookieJar implements \ArrayAccess, \IteratorAggregate {
	/**
	 * Actual item data
	 *
	 * @var array
	 */
	protected $cookies = array();

	/**
	 * Create a new jar
	 *
	 * @param array $cookies Existing cookie values
	 */
	public function __construct($cookies = array()) {
		$this->cookies = $cookies;
	}

	/**
	 * Normalise cookie data into a RequestsCookie
	 *
	 * @param string|RequestsCookie $cookie
	 * @return RequestsCookie
	 */
	public function normalizeCookie($cookie, $key = null) {
		if ($cookie instanceof RequestsCookie) {
			return $cookie;
		}

		return RequestsCookie::parse($cookie, $key);
	}

	/**
	 * Check if the given item exists
	 *
	 * @param string $key Item key
	 * @return boolean Does the item exist?
	 */
	public function offsetExists($key) {
		return isset($this->cookies[$key]);
	}

	/**
	 * Get the value for the item
	 *
	 * @param string $key Item key
	 * @return string Item value
	 */
	public function offsetGet($key) {
		if (!isset($this->cookies[$key]))
			return null;

		return $this->cookies[$key];
	}

	/**
	 * Set the given item
	 *
	 * @throws Requests_Exception On attempting to use dictionary as list (`invalidset`)
	 *
	 * @param string $key Item name
	 * @param string $value Item value
	 */
	public function offsetSet($key, $value) {
		if ($key === null) {
			throw new Requests_Exception('Object is a dictionary, not a list', 'invalidset');
		}

		$this->cookies[$key] = $value;
	}

	/**
	 * Unset the given header
	 *
	 * @param string $key
	 */
	public function offsetUnset($key) {
		unset($this->cookies[$key]);
	}

	/**
	 * Get an iterator for the data
	 *
	 * @return ArrayIterator
	 */
	public function getIterator() {
		return new \ArrayIterator($this->cookies);
	}

	/**
	 * Register the cookie handler with the request's hooking system
	 *
	 * @param Requests_Hooker $hooks Hooking system
	 */
	public function register(Hooker $hooks) {
		$hooks->register('requests.before_request', array($this, 'before_request'));
		$hooks->register('requests.before_redirect_check', array($this, 'before_redirect_check'));
	}

	/**
	 * Add Cookie header to a request if we have any
	 *
	 * As per RFC 6265, cookies are separated by '; '
	 *
	 * @param string $url
	 * @param array $headers
	 * @param array $data
	 * @param string $type
	 * @param array $options
	 */
	public function before_request(&$url, &$headers, &$data, &$type, &$options) {
		if (!empty($this->cookies)) {
			$cookies = array();
			foreach ($this->cookies as $key => $cookie) {
				$cookie = $this->normalizeCookie($cookie, $key);
				$cookies[] = $cookie->formatForHeader();
			}

			$headers['Cookie'] = implode('; ', $cookies);
		}
	}

	/**
	 * Parse all cookies from a response and attach them to the response
	 *
	 * @var RequestsResponse $response
	 */
	public function before_redirect_check(RequestsResponse &$return) {
		$cookies = RequestsCookie::parseFromHeaders($return->headers);
		$this->cookies = array_merge($this->cookies, $cookies);
		$return->cookies = $this;
	}
}