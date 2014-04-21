<?

namespace drey\Prefs\DB;

/**
 * Minimal features of a storage for Prefs
 */
interface PrefsDB
{
	/**
	 * Get value of the (name,username) key
	 * @param  string $name
	 * @param  string $username
	 * @return mixed If the value is found: an StdClass object 
	 * $row->value. if the value is not found returns FALSE.
	 */
    public function get($name, $username);
    /**
	 * Get value of the (name,username) key
	 * @param  string $name
	 * @param  string $value
	 */
    public function set($name, $value, $username);

    /**
     * Delete a (name, username) key and value
     * @param  string $name
     * @param  string $username
     */
    public function delete($name, $username);

    /**
     * Return all (name,username) values
     * @param  string $username
     * @return Array All (name=>value) pairs of username;
     */
    public function getAll($username);

    /**
     * Delete all (name,username) values
     * @param  string $username
     */
	public function deleteAll($username);
}
