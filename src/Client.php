<?php

namespace MehrAlsNix\PhpFtp;

/**
 * Class Client
 * @package MehrAlsNix\PhpFtp
 */
class Client
{
    /**
     * Option to let the ls() method return only files.
     * @see Client::ls()
     */
    public const FILES_ONLY = 0;

    /**
     * Option to let the ls() method return only directories.
     * @see Client::ls()
     */
    public const DIRS_ONLY = 1;

    /**
     * Option to let the ls() method return directories and files (default).
     * @see Client::ls()
     */
    public const DIRS_FILES = 2;

    /**
     * Option to let the ls() method return the raw directory listing from ftp_rawlist()
     * @see Client::ls()
     */
    public const RAWLIST = 3;

    /**
     * Option to indicate that non-blocking features should not be used in
     * put(). This will also disable the listener functionality as a side effect.
     * @see Client::put()
     */
    public const BLOCKING = 1;

    /**
     * Option to indicate that non-blocking features should be used if available in
     * put(). This will also enable the listener functionality.
     *
     * This is the default behaviour.
     * @see Client::put()
     */
    public const NONBLOCKING = 2;

    /**
     * Error code to indicate a failed connection
     * This error code indicates, that the connection you tryed to set up
     * could not be established. Check your connection settings (host & port)!
     * @see Client::connect()
     */
    public const ERR_CONNECT_FAILED = -1;

    /**
     * Error code to indicate a failed login
     * This error code indicates, that the login to the FTP server failed. Check
     * your user data (username & password).
     * @see Client::login()
     */
    public const ERR_LOGIN_FAILED = -2;

    /**
     * Error code to indicate a failed directory change
     * The cd() method failed. Ensure that the directory you wanted to access exists.
     * @see Client::cd()
     */
    public const ERR_DIRCHANGE_FAILED = 2;

    /**
     * Error code to indicate that Net_FTP could not determine the current path
     * The pwd() method failed and could not determine the path you currently reside
     * in on the FTP server.
     * @see Client::pwd()
     */
    public const ERR_DETERMINEPATH_FAILED = 4;

    /**
     * Error code to indicate that the creation of a directory failed
     * The directory you tryed to create could not be created. Check the
     * access rights on the parent directory!
     * @see Client::mkdir()
     */
    public const ERR_CREATEDIR_FAILED = -4;

    /**
     * Error code to indicate that the EXEC execution failed.
     * The execution of a command using EXEC failed. Ensure, that your
     * FTP server supports the EXEC command.
     * @see Client::execute()
     */
    public const ERR_EXEC_FAILED = -5;

    /**
     * Error code to indicate that the SITE command failed.
     * The execution of a command using SITE failed. Ensure, that your
     * FTP server supports the SITE command.
     * @see Client::site()
     */
    public const ERR_SITE_FAILED = -6;

    /**
     * Error code to indicate that the CHMOD command failed.
     * The execution of CHMOD failed. Ensure, that your
     * FTP server supports the CHMOD command and that you have the appropriate
     * access rights to use CHMOD.
     * @see Client::chmod()
     */
    public const ERR_CHMOD_FAILED = -7;

    /**
     * Error code to indicate that a file rename failed
     * The renaming of a file on the server failed. Ensure that you have the
     * appropriate access rights to rename the file.
     * @see Client::rename()
     */
    public const ERR_RENAME_FAILED = -8;

    /**
     * Error code to indicate that the MDTM command failed
     * The MDTM command is not supported for directories. Ensure that you gave
     * a file path to the mdtm() method, not a directory path.
     * @see Client::mdtm()
     */
    public const ERR_MDTMDIR_UNSUPPORTED = -9;

    /**
     * Error code to indicate that the MDTM command failed
     * The MDTM command failed. Ensure that your server supports the MDTM command.
     * @see Client::mdtm()
     */
    public const ERR_MDTM_FAILED = -10;

    /**
     * Error code to indicate that a date returned by the server was misformated
     * A date string returned by your server seems to be missformated and could not be
     * parsed. Check that the server is configured correctly. If you're sure, please
     * send an email to the auhtor with a dumped output of
     * $ftp->ls('./', self::RAWLIST); to get the date format supported.
     * @see Client::mdtm(), Client::ls()
     */
    public const ERR_DATEFORMAT_FAILED = -11;

    /**
     * Error code to indicate that the SIZE command failed
     * The determination of the filesize of a file failed. Ensure that your server
     * supports the SIZE command.
     * @see Client::size()
     */
    public const ERR_SIZE_FAILED = -12;

    /**
     * Error code to indicate that a local file could not be overwritten
     * You specified not to overwrite files. Therefore the local file has not been
     * overwriten. If you want to get the file overwriten, please set the option to
     * do so.
     * @see Client::get(), Client::getRecursive()
     */
    public const ERR_OVERWRITELOCALFILE_FORBIDDEN = -13;

    /**
     * Error code to indicate that a local file could not be overwritten
     * Also you specified to overwrite the local file you want to download to,
     * it has not been possible to do so. Check that you have the appropriate access
     * rights on the local file to overwrite it.
     * @see Client::get(), Client::getRecursive()
     */
    public const ERR_OVERWRITELOCALFILE_FAILED = -14;

    /**
     * Error code to indicate that the file you wanted to upload does not exist
     * The file you tried to upload does not exist. Ensure that it exists.
     * @see Client::put(), Client::putRecursive()
     */
    public const ERR_LOCALFILENOTEXIST = -15;

    /**
     * Error code to indicate that a remote file could not be overwritten
     * You specified not to overwrite files. Therefore the remote file has not been
     * overwriten. If you want to get the file overwriten, please set the option to
     * do so.
     * @see Client::put(), Client::putRecursive()
     */
    public const ERR_OVERWRITEREMOTEFILE_FORBIDDEN = -16;

    /**
     * Error code to indicate that the upload of a file failed
     * The upload you tried failed. Ensure that you have appropriate access rights
     * to upload the desired file.
     * @see Client::put(), Client::putRecursive()
     */
    public const ERR_UPLOADFILE_FAILED = -17;

    /**
     * Error code to indicate that you specified an incorrect directory path
     * The remote path you specified seems not to be a directory. Ensure that
     * the path you specify is a directory and that the path string ends with
     * a /.
     * @see Client::putRecursive(), Client::getRecursive()
     */
    public const ERR_REMOTEPATHNODIR = -18;

    /**
     * Error code to indicate that you specified an incorrect directory path
     * The local path you specified seems not to be a directory. Ensure that
     * the path you specify is a directory and that the path string ends with
     * a /.
     * @see Client::putRecursive(), Client::getRecursive()
     */
    public const ERR_LOCALPATHNODIR = -19;

    /**
     * Error code to indicate that a local directory failed to be created
     * You tried to create a local directory through getRecursive() method,
     * which has failed. Ensure that you have the appropriate access rights
     * to create it.
     * @see Client::getRecursive()
     */
    public const ERR_CREATELOCALDIR_FAILED = -20;

    /**
     * Error code to indicate that the provided hostname was incorrect
     * The hostname you provided was invalid. Ensure to provide either a
     * full qualified domain name or an IP address.
     * @see Client::setHostname()
     */
    public const ERR_HOSTNAMENOSTRING = -21;

    /**
     * Error code to indicate that the provided port was incorrect
     * The port number you provided was invalid. Ensure to provide either a
     * a numeric port number greater zero.
     * @see Client::setPort()
     */
    public const ERR_PORTLESSZERO = -22;

    /**
     * Error code to indicate that you provided an invalid mode constant
     * The mode constant you provided was invalid. You may only provide
     * FTP_ASCII or FTP_BINARY.
     * @see Client::setMode()
     */
    public const ERR_NOMODECONST = -23;

    /**
     * Error code to indicate that you provided an invalid timeout
     * The timeout you provided was invalid. You have to provide a timeout greater
     * or equal to zero.
     * @see Client::Net_FTP(), Client::setTimeout()
     */
    public const ERR_TIMEOUTLESSZERO = -24;

    /**
     * Error code to indicate that you provided an invalid timeout
     * An error occured while setting the timeout. Ensure that you provide a
     * valid integer for the timeount and that your PHP installation works
     * correctly.
     * @see Client::Net_FTP(), Client::setTimeout()
     */
    public const ERR_SETTIMEOUT_FAILED = -25;

    /**
     * Error code to indicate that the provided extension file doesn't exist
     * The provided extension file does not exist. Ensure to provided an
     * existant extension file.
     * @see Client::getExtensionsFile()
     */
    public const ERR_EXTFILENOTEXIST = -26;

    /**
     * Error code to indicate that the provided extension file is not readable
     * The provided extension file is not readable. Ensure to have sufficient
     * access rights for it.
     * @see Client::getExtensionsFile()
     */
    public const ERR_EXTFILEREAD_FAILED = -27;

    /**
     * Error code to indicate that the deletion of a file failed
     * The specified file could not be deleted. Ensure to have sufficient
     * access rights to delete the file.
     * @see Client::rm()
     */
    public const ERR_DELETEFILE_FAILED = -28;

    /**
     * Error code to indicate that the deletion of a directory faild
     * The specified file could not be deleted. Ensure to have sufficient
     * access rights to delete the file.
     * @see Client::rm()
     */
    public const ERR_DELETEDIR_FAILED = -29;

    /**
     * Error code to indicate that the directory listing failed
     * PHP could not list the directory contents on the server. Ensure
     * that your server is configured appropriate.
     * @see Client::ls()
     */
    public const ERR_RAWDIRLIST_FAILED = -30;

    /**
     * Error code to indicate that the directory listing failed
     * The directory listing format your server uses seems not to
     * be supported by Net_FTP. Please send the output of the
     * call ls('./', self::RAWLIST); to the author of this
     * class to get it supported.
     * @see Client::ls()
     */
    public const ERR_DIRLIST_UNSUPPORTED = -31;

    /**
     * Error code to indicate failed disconnecting
     * This error code indicates, that disconnection was not possible.
     * @see Client::disconnect()
     */
    public const ERR_DISCONNECT_FAILED = -32;

    /**
     * Error code to indicate that the username you provided was invalid.
     * Check that you provided a non-empty string as the username.
     * @see Client::setUsername()
     */
    public const ERR_USERNAMENOSTRING = -33;

    /**
     * Error code to indicate that the username you provided was invalid.
     * Check that you provided a non-empty string as the username.
     * @see Client::setPassword()
     */
    public const ERR_PASSWORDNOSTRING = -34;

    /**
     * Error code to indicate that the provided extension file is not loadable
     * The provided extension file is not loadable. Ensure to have a correct file
     * syntax.
     * @see Client::getExtensionsFile()
     */
    public const ERR_EXTFILELOAD_FAILED = -35;

    /**
     * Error code to indicate that the directory listing pattern provided is not a
     * string.
     * @see Client::setDirMatcher()
     */
    public const ERR_ILLEGALPATTERN = -36;

    /**
     * Error code to indicate that the directory listing matcher map provided is not an
     * array.
     * @see Client::setDirMatcher()
     */
    public const ERR_ILLEGALMAP = -37;

    /**
     * Error code to indicate that the directory listing matcher map provided contains
     * wrong values (ie: it contains non-numerical values)
     * @see Client::setDirMatcher()
     */
    public const ERR_ILLEGALMAPVALUE = -38;

    /**
     * Error code indicating that bad options were supplied to the
     * put() method.
     * @see Client::put()
     */
    public const ERR_BADOPTIONS = -39;

    /**
     * Error code indicating that SSL connection is not supported as either the
     * ftp module or OpenSSL support is not statically built into php.
     * @see Client::setSsl()
     */
    public const ERR_NOSSL = -40;

    /**
     * The host to connect to
     *
     * @var     string
     */
    private $hostname;

    /**
     * The port for ftp-connection (standard is 21)
     *
     * @var     int
     */
    private $port = 21;

    /**
     * The username for login
     *
     * @var     string
     */
    private $username;

    /**
     * The password for login
     *
     * @var     string
     */
    private $password;

    /**
     * Determine whether to connect through secure SSL connection or not
     *
     * Is null when it hasn't been explicitly set
     *
     * @var     bool
     */
    private $ssl;

    /**
     * Determine whether to use passive-mode (true) or active-mode (false)
     *
     * Is null when it hasn't been explicitly set
     *
     * @var     bool
     */
    private $passv;

    /**
     * The standard mode for ftp-transfer
     *
     * @var     int
     */
    private $mode = FTP_BINARY;

    /**
     * This holds the handle for the ftp-connection
     *
     * If null, the connection hasn't been setup yet. If false, the connection
     * attempt has failed. Else, it contains an ftp resource.
     *
     * @var     resource
     */
    private $handle;

    /**
     * Contains the timeout for FTP operations
     *
     * @var     int
     */
    private $timeout;

    /**
     * Saves file-extensions for ascii- and binary-mode
     *
     * The array is built like this: 'php' => FTP_ASCII, 'png' => FTP_BINARY
     *
     * @var     array
     */
    private $fileExtensions = [];

    /**
     * ls match
     * Matches the ls entries against a regex and maps the resulting array to
     * speaking names
     *
     * The values are set in the constructor because of line length constaints.
     *
     * Typical lines for the Windows format:
     * 07-05-07  08:40AM                 4701 SomeFile.ext
     * 04-29-07  10:28PM       <DIR>          SomeDir
     *
     * @var     array
     * @since   1.3
     */
    private $lsMatch;

    /**
     * matcher
     * Stores the matcher for the current connection
     *
     * @var     array
     * @since   1.3
     */
    private $matcher;

    /**
     * Holds all Net_FTP_Observer objects
     * that wish to be notified of new messages.
     *
     * @var     array
     * @since   1.3
     */
    private $listeners = [];

    /**
     * Is true when a login has been performed
     * and was successful
     *
     * @var     boolean
     * @since   1.4
     */
    private $loggedin = false;

    /**
     * This generates a new FTP-Object. The FTP-connection will not be established,
     * yet.
     * You can leave $host and $port blank, if you want. The $host will not be set
     * and the $port will be left at 21. You have to set the $host manualy before
     * trying to connect or with the connect() method.
     *
     * @param string $host (optional) The hostname
     * @param int $port (optional) The port
     * @param int $timeout (optional) Sets the standard timeout
     *
     * @return void
     * @see Client::setHostname(), Client::setPort(), Client::connect()
     */
    public function __construct(string $host = null, int $port = null, int $timeout = 90)
    {
        if (isset($host)) {
            $this->setHostname($host);
        }
        if (isset($port)) {
            $this->setPort($port);
        }
        $this->timeout = $timeout;

        $this->lsMatch = [
            'unix' => [
                'pattern' => '/(?:(d)|.)([rwxts-]{9})\s+(\w+)\s+([\w\d-()?.]+)\s+' .
                    '([\w\d-()?.]+)\s+(\w+)\s+(\S+\s+\S+\s+\S+)\s+(.+)/',
                'map' => [
                    'is_dir' => 1,
                    'rights' => 2,
                    'files_inside' => 3,
                    'user' => 4,
                    'group' => 5,
                    'size' => 6,
                    'date' => 7,
                    'name' => 8,
                ]
            ],
            'windows' => [
                'pattern' => '/([0-9\-]+\s+[0-9:APM]+)\s+((<DIR>)|\d+)\s+(.+)/',
                'map' => [
                    'date' => 1,
                    'size' => 2,
                    'is_dir' => 3,
                    'name' => 4,
                ]
            ]
        ];
    }

    /**
     * This function close the FTP-connection
     *
     * @return bool Returns true on success, PEAR_Error on failure
     */
    public function disconnect(): bool
    {
        $res = @ftp_close($this->handle);
        if (!$res) {
            throw new \RuntimeException('Disconnect failed.', self::ERR_DISCONNECT_FAILED);
        }
        $this->handle = null;
        return true;
    }

    /**
     * This logs you into the ftp-server. You are free to specify username and
     * password in this method. If you specify it, the values will be taken into
     * the corresponding attributes, if do not specify, the attributes are taken.
     *
     * If connect() has not been called yet, a connection will be setup
     *
     * @param string $username (optional) The username to use
     * @param string $password (optional) The password to use
     *
     * @return true on success
     * @throws \RuntimeException
     * @see Client::ERR_LOGIN_FAILED
     */
    public function login($username = null, $password = null)
    {
        if ($this->handle === null) {
            $this->connect();
        }

        if (!isset($username)) {
            $username = $this->getUsername();
        } else {
            $this->setUsername($username);
        }

        if (!isset($password)) {
            $password = $this->getPassword();
        } else {
            $this->setPassword($password);
        }

        $res = @ftp_login($this->handle, $username, $password);

        if (!$res) {
            throw new \RuntimeException("Unable to login", self::ERR_LOGIN_FAILED);
        }

        $this->loggedin = true;

        // distinguish between null and false, null means this setting wasn't
        // explicitly changed, so we only change it when setPassive or
        // setActive was called by the user
        if ($this->passv === true) {
            $this->setPassive();
        } elseif ($this->passv === false) {
            $this->setActive();
        }

        return true;
    }

    /**
     * This function generates the FTP-connection. You can optionally define a
     * hostname and/or a port. If you do so, this data is stored inside the object.
     *
     * @param string $host (optional) The Hostname
     * @param int $port (optional) The Port
     * @param bool $ssl (optional) Whether to connect through secure SSL connection
     *
     * @return true on success
     * @throws \RuntimeException
     * @see Client::ERR_CONNECT_FAILED
     */
    public function connect($host = null, $port = null, $ssl = null)
    {
        $this->matcher = null;
        if (isset($host)) {
            $this->setHostname($host);
        }
        if (isset($port)) {
            $this->setPort($port);
        }
        if (isset($ssl) && is_bool($ssl) && $ssl) {
            $this->setSsl();
        }
        if ($this->getSsl()) {
            $handle = @ftp_ssl_connect($this->getHostname(), $this->getPort(),
                $this->timeout);
        } else {
            $handle = @ftp_connect($this->getHostname(), $this->getPort(),
                $this->timeout);
        }
        if (!$handle) {
            $this->handle = false;
            throw new \RuntimeException("Connection to host failed",
                self::ERR_CONNECT_FAILED);
        }

        $this->handle =& $handle;
        return true;
    }

    /**
     * Returns whether to connect through secure SSL connection
     *
     * @return bool True if with SSL, false if without SSL
     */
    public function getSsl(): bool
    {
        return (bool) $this->ssl;
    }

    /**
     * Set to connect through secure SSL connection
     *
     * @return bool True on success
     */
    public function setSsl(): bool
    {
        if (!function_exists('ftp_ssl_connect')) {
            throw new \RuntimeException('SSL connection not supported. Function ftp_ssl_connect does not exist.',
                self::ERR_NOSSL);
        }
        $this->ssl = true;
        return true;
    }

    /**
     * Returns the hostname
     *
     * @return string The hostname
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * Set the hostname
     *
     * @param string $host The hostname to set
     *
     * @return bool True on success
     * @see Client::ERR_HOSTNAMENOSTRING
     */
    public function setHostname($host): bool
    {
        if (!is_string($host)) {
            throw new \RuntimeException("Hostname must be a string.",
                self::ERR_HOSTNAMENOSTRING);
        }
        $this->hostname = $host;
        return true;
    }

    /**
     * Returns the port
     *
     * @return int The port
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Set the Port
     *
     * @param int $port The port to set
     *
     * @return bool True on success
     * @see Client::ERR_PORTLESSZERO
     */
    public function setPort($port): bool
    {
        if (!is_int($port) || ($port < 0)) {
            throw new \RuntimeException("Invalid port. Has to be integer >= 0",
                self::ERR_PORTLESSZERO);
        }
        $this->port = $port;
        return true;
    }

    /**
     * Returns the username
     *
     * @return string The username
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the Username
     *
     * @param string $user The username to set
     *
     * @return true on success
     * @see Client::ERR_USERNAMENOSTRING
     */
    public function setUsername(string $user)
    {
        if (empty($user)) {
            throw new \RuntimeException('Username $user invalid.', self::ERR_USERNAMENOSTRING);
        }
        $this->username = $user;
        return true;
    }

    /**
     * Returns the password
     *
     * @return string The password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the password
     *
     * @param string $password The password to set
     *
     * @return true on success
     * @see Client::ERR_PASSWORDNOSTRING
     */
    public function setPassword(string $password)
    {
        if (empty($password)) {
            throw new \RuntimeException('Password xxx invalid.', self::ERR_PASSWORDNOSTRING);
        }
        $this->password = $password;
        return true;
    }

    /**
     * Set the transfer-method to passive mode
     *
     * @return void
     */
    public function setPassive(): void
    {
        $this->passv = true;
        if ($this->handle !== null && $this->loggedin) {
            @ftp_pasv($this->handle, true);
        }
    }

    /**
     * Set the transfer-method to active mode
     *
     * @return void
     */
    public function setActive(): void
    {
        $this->passv = false;
        if ($this->handle !== null && $this->loggedin) {
            @ftp_pasv($this->handle, false);
        }
    }

    /**
     * This method tries executing a command on the ftp, using SITE EXEC.
     *
     * @param string $command The command to execute
     *
     * @return bool the result of the command (if successfull)
     * @see Client::ERR_EXEC_FAILED
     */
    public function execute($command): bool
    {
        $res = @ftp_exec($this->handle, $command);
        if (!$res) {
            throw new \RuntimeException("Execution of command '$command' failed.",
                self::ERR_EXEC_FAILED);
        }

        return $res;
    }

    /**
     * This method will try to chmod a folder and all of its contents
     * on the server. The target argument must be a folder or an array of folders
     * and the permissions argument have to be an integer (i.e. 777).
     * The file can be either a relative or absolute path.
     * NOTE: Some servers do not support this feature. In that case, you
     * will get a PEAR error object returned. If successful, the method
     * returns true
     *
     * @param mixed $target The folder or array of folders to
     *                             set permissions for
     * @param integer $permissions The mode to set the folder
     *                             and file permissions to
     *
     * @return true if successful
     * @see Client::ERR_CHMOD_FAILED, Client::ERR_DETERMINEPATH_FAILED,
     * @see Client::ERR_RAWDIRLIST_FAILED, self::ERR_DIRLIST_UNSUPPORTED
     */
    public function chmodRecursive($target, $permissions): bool
    {
        static $dir_permissions;

        if (!isset($dir_permissions)) { // Making directory specific permissions
            $dir_permissions = $this->makeDirPermissions($permissions);
        }

        // If $target is an array: Loop through it
        if (is_array($target)) {
            foreach ($target as $iValue) {
                $this->chmodRecursive($iValue, $permissions);
            }
        } else {
            $remote_path = $this->constructPath($target);
            // Chmod the directory itself
            $this->chmod($remote_path, $dir_permissions);

            // If $remote_path last character is not a slash, add one
            if (substr($remote_path, strlen($remote_path) - 1) !== "/") {

                $remote_path .= "/";
            }

            $mode = self::DIRS_ONLY;
            $dir_list = $this->ls($remote_path, $mode);

            foreach ($dir_list as $dir_entry) {
                if ($dir_entry['name'] === '.' || $dir_entry['name'] === '..') {
                    continue;
                }

                $remote_path_new = $remote_path . $dir_entry["name"] . "/";

                // Chmod the directory we're about to enter
                $this->chmod($remote_path_new, $dir_permissions);
                $this->chmodRecursive($remote_path_new, $permissions);
            }

            $mode = self::FILES_ONLY;
            $file_list = $this->ls($remote_path, $mode);

            foreach ($file_list as $file_entry) {
                $remote_file = $remote_path . $file_entry["name"];
                $this->chmod($remote_file, $permissions);
            }
        }

        return true;
    }

    /**
     * This will return logical permissions mask for directory.
     * if directory has to be readable it have also be executable
     *
     * @param string $permissions File permissions in digits for file (i.e. 666)
     *
     * @return string File permissions in digits for directory (i.e. 777)
     */
    private function makeDirPermissions(string $permissions): string
    {
        // going through (user, group, world)
        for ($i = 0, $iMax = strlen($permissions); $i < $iMax; $i++) {
            // Read permission is set but execute not yet
            if ((int) $permissions[$i] & 4 and !((int) $permissions[$i] & 1)) {
                // Adding execute flag
                $permissions[$i] = (int) $permissions[$i] + 1;
            }
        }

        return $permissions;
    }

    /**
     * Rebuild the path, if given relative
     *
     * This method will make a relative path absolute by prepending the current
     * remote directory in front of it.
     *
     * @param string $path The path to check and construct
     *
     * @return string The build path
     */
    private function constructPath($path): string
    {
        if ((substr($path, 0, 1) !== '/') && (substr($path, 0, 2) !== './')) {
            $actual_dir = @ftp_pwd($this->handle);
            if (substr($actual_dir, -1) !== '/') {
                $actual_dir .= '/';
            }
            $path = $actual_dir . $path;
        }
        return $path;
    }

    /**
     * This method will try to chmod the file specified on the server
     * Currently, you must give a number as the the permission argument (777 or
     * similar). The file can be either a relative or absolute path.
     * NOTE: Some servers do not support this feature. In that case, you will
     * get a PEAR error object returned. If successful, the method returns true
     *
     * @param mixed $target The file or array of files to set permissions for
     * @param integer $permissions The mode to set the file permissions to
     *
     * @return true
     * @see Client::ERR_CHMOD_FAILED
     */
    public function chmod($target, $permissions): bool
    {
        if (is_array($target)) {
            foreach ($target as $iValue) {
                $this->chmod($iValue, $permissions);
            }

            return true;
        }

        try {
            $this->site("CHMOD " . $permissions . " " . $target);
        } catch (\RuntimeException $e) {
            throw new \RuntimeException("CHMOD " . $permissions . " " . $target . " failed", self::ERR_CHMOD_FAILED, $e);
        }

        return true;
    }

    /**
     * Execute a SITE command on the server
     * This method tries to execute a SITE command on the ftp server.
     *
     * @param string $command The command with parameters to execute
     *
     * @return bool True if successful
     * @throws \RuntimeException
     * @see Client::ERR_SITE_FAILED
     */
    public function site(string $command): bool
    {
        $res = @ftp_site($this->handle, $command);
        if (!$res) {
            throw new \RuntimeException("Execution of SITE command '$command' failed.", self::ERR_SITE_FAILED);
        }

        return $res;
    }

    /**
     * This method returns a directory-list of the current directory or given one.
     * To display the current selected directory, simply set the first parameter to
     * null
     * or leave it blank, if you do not want to use any other parameters.
     * <br><br>
     * There are 4 different modes of listing directories. Either to list only
     * the files (using self::FILES_ONLY), to list only directories (using
     * self::DIRS_ONLY) or to show both (using self::DIRS_FILES, which is
     * default).
     * <br><br>
     * The 4th one is the self::RAWLIST, which returns just the array created by
     * the ftp_rawlist()-function build into PHP.
     * <br><br>
     * The other function-modes will return an array containing the requested data.
     * The files and dirs are listed in human-sorted order, but if you select
     * self::DIRS_FILES the directories will be added above the files,
     * but although both sorted.
     * <br><br>
     * All elements in the arrays are associative arrays themselves. They have the
     * following structure:
     * <br><br>
     * Dirs:<br>
     *           ["name"]        =>  string The name of the directory<br>
     *           ["rights"]      =>  string The rights of the directory (in style
     *                               "rwxr-xr-x")<br>
     *           ["user"]        =>  string The owner of the directory<br>
     *           ["group"]       =>  string The group-owner of the directory<br>
     *           ["files_inside"]=>  string The number of files/dirs inside the
     *                               directory excluding "." and ".."<br>
     *           ["date"]        =>  int The creation-date as Unix timestamp<br>
     *           ["is_dir"]      =>  bool true, cause this is a dir<br>
     * <br><br>
     * Files:<br>
     *           ["name"]        =>  string The name of the file<br>
     *           ["size"]        =>  int Size in bytes<br>
     *           ["rights"]      =>  string The rights of the file (in style
     *                               "rwxr-xr-x")<br>
     *           ["user"]        =>  string The owner of the file<br>
     *           ["group"]       =>  string The group-owner of the file<br>
     *           ["date"]        =>  int The creation-date as Unix timestamp<br>
     *           ["is_dir"]      =>  bool false, cause this is a file<br>
     *
     * @param string $dir (optional) The directory to list or null, when listing
     *                     the current directory.
     * @param int $mode (optional) The mode which types to list (files,
     *                     directories or both).
     *
     * @return array the directory list as described above
     * @see Client::DIRS_FILES, Client::DIRS_ONLY, self::FILES_ONLY,
     * @see Client::RAWLIST, Client::ERR_DETERMINEPATH_FAILED,
     * @see Client::ERR_RAWDIRLIST_FAILED, Client::ERR_DIRLIST_UNSUPPORTED
     */
    public function ls($dir = null, $mode = self::DIRS_FILES)
    {
        if (!isset($dir)) {
            $dir = @ftp_pwd($this->handle);
            if (!$dir) {
                throw new \RuntimeException("Could not retrieve current directory",
                    self::ERR_DETERMINEPATH_FAILED);
            }
        }
        if (($mode != self::FILES_ONLY) && ($mode != self::DIRS_ONLY) &&
            ($mode != self::RAWLIST)) {
            $mode = self::DIRS_FILES;
        }

        switch ($mode) {
            case self::DIRS_FILES:
                $res = $this->lsBoth($dir);
                break;
            case self::DIRS_ONLY:
                $res = $this->lsDirs($dir);
                break;
            case self::FILES_ONLY:
                $res = $this->lsFiles($dir);
                break;
            case self::RAWLIST:
                $res = @ftp_rawlist($this->handle, $dir);
                break;
        }

        return $res;
    }

    /**
     * Lists up files and directories
     *
     * @param string $dir The directory to list up
     *
     * @return array An array of dirs and files
     */
    private function lsBoth($dir): array
    {
        $list_splitted = $this->listAndParse($dir);
        if (!is_array($list_splitted["files"])) {
            $list_splitted["files"] = [];
        }
        if (!is_array($list_splitted["dirs"])) {
            $list_splitted["dirs"] = [];
        }
        $res = [];
        @array_splice($res, 0, 0, $list_splitted["files"]);
        @array_splice($res, 0, 0, $list_splitted["dirs"]);
        return $res;
    }

    /**
     * This lists up the directory-content and parses the items into well-formated
     * arrays.
     * The results of this array are sorted (dirs on top, sorted by name;
     * files below, sorted by name).
     *
     * @param string $dir The directory to parse
     *
     * @return array Lists of dirs and files
     * @see Client::ERR_RAWDIRLIST_FAILED
     */
    private function listAndParse($dir): array
    {
        $dirs_list = [];
        $files_list = [];
        $dir_list = @ftp_rawlist($this->handle, $dir);
        if (!is_array($dir_list)) {
            throw new \RuntimeException('Could not get raw directory listing.',
                self::ERR_RAWDIRLIST_FAILED);
        }

        foreach ($dir_list as $k => $v) {
            if (strncmp($v, 'total: ', 7) === 0 && preg_match('/total: \d+/', $v)) {
                unset($dir_list[$k]);
                break; // usually there is just one line like this
            }
        }

        // Handle empty directories
        if (count($dir_list) === 0) {
            return ['dirs' => $dirs_list, 'files' => $files_list];
        }

        // Exception for some FTP servers seem to return this wiered result instead
        // of an empty list
        if (count($dirs_list) == 1 && $dirs_list[0] === 'total 0') {
            return ['dirs' => [], 'files' => $files_list];
        }

        if (!isset($this->matcher)) {
            $this->matcher = $this->determineOSMatch($dir_list);
        }
        foreach ($dir_list as $entry) {
            $m = [];
            if (!preg_match($this->matcher['pattern'], $entry, $m)) {
                continue;
            }
            $entry = [];
            foreach ($this->matcher['map'] as $key => $val) {
                $entry[$key] = $m[$val];
            }
            $entry['stamp'] = $this->parseDate($entry['date']);

            if ($entry['is_dir']) {
                $dirs_list[] = $entry;
            } else {
                $files_list[] = $entry;
            }
        }
        @usort($dirs_list, ['Client', 'natSort']);
        @usort($files_list, ['Client', 'natSort']);
        $res["dirs"] = (is_array($dirs_list)) ? $dirs_list : [];
        $res["files"] = (is_array($files_list)) ? $files_list : [];
        return $res;
    }

    /**
     * Determine server OS
     * This determines the server OS and returns a valid regex to parse
     * ls() output.
     *
     * @param array $dir_list The raw dir list to parse
     *
     * @return mixed An array of 'pattern' and 'map' on success, otherwise
     *               PEAR::Error
     * @see Client::ERR_DIRLIST_UNSUPPORTED
     */
    private function determineOSMatch(array $dir_list)
    {
        foreach ($dir_list as $entry) {
            foreach ($this->lsMatch as $match) {
                if (preg_match($match['pattern'], $entry)) {
                    return $match;
                }
            }
        }
        $error = 'The list style of your server seems not to be supported. Please' .
            'email a "$ftp->ls(self::RAWLIST);" output plus info on the' .
            'server to the maintainer of this package to get it supported!' .
            'Thanks for your help!';
        throw new \RuntimeException($error, self::ERR_DIRLIST_UNSUPPORTED);
    }

    /**
     * Parse dates to timestamps
     *
     * @param string $date Date
     *
     * @return int Timestamp
     * @see Client::ERR_DATEFORMAT_FAILED
     */
    private function parseDate($date): int
    {
        // Sep 10 22:06 => Sep 10, <year> 22:06
        $res = [];
        if (preg_match('/([A-Za-z]+)[ ]+([0-9]+)[ ]+([0-9]+):([0-9]+)/', $date, $res)) {
            $year = date('Y');
            $month = $res[1];
            $day = $res[2];
            $hour = $res[3];
            $minute = $res[4];
            $date = "$month $day, $year $hour:$minute";
            $tmpDate = strtotime($date);
            if ($tmpDate > time()) {
                $year--;
                $date = "$month $day, $year $hour:$minute";
            }
        } elseif (preg_match('/^\d\d-\d\d-\d\d/', $date)) {
            // 09-10-04 => 09/10/04
            $date = str_replace('-', '/', $date);
        }
        $res = strtotime($date);
        if (!$res) {
            throw new \RuntimeException('Dateconversion failed.', self::ERR_DATEFORMAT_FAILED);
        }
        return $res;
    }

    /**
     * Lists up directories
     *
     * @param string $dir The directory to list up
     *
     * @return array An array of dirs
     * @throws \RuntimeException
     */
    private function lsDirs(string $dir): array
    {
        $list = $this->listAndParse($dir);

        return $list["dirs"];
    }

    /**
     * Lists up files
     *
     * @param string $dir The directory to list up
     *
     * @return array An array of files
     */
    private function lsFiles(string $dir): array
    {
        $list = $this->listAndParse($dir);

        return $list["files"];
    }

    /**
     * Rename or move a file or a directory from the ftp-server
     *
     * @param string $remote_from The remote file or directory original to rename or
     *                            move
     * @param string $remote_to The remote file or directory final to rename or
     *                            move
     *
     * @return bool $res True on success
     * @see Client::ERR_RENAME_FAILED
     */
    public function rename($remote_from, $remote_to): bool
    {
        $res = @ftp_rename($this->handle, $remote_from, $remote_to);
        if (!$res) {
            throw new \RuntimeException("Could not rename " . $remote_from . " to " .
                $remote_to . " !", self::ERR_RENAME_FAILED);
        }
        return true;
    }

    /**
     * This will return the last modification-time of a file. You can either give
     * this function a relative or an absolute path to the file to check.
     * NOTE: Some servers will not support this feature and the function works
     * only on files, not directories! When successful,
     * it will return the last modification-time as a unix-timestamp or, when
     * $format is specified, a preformated timestring.
     *
     * @param string $file The file to check
     * @param string $format (optional) The format to give the date back
     *                       if not set, it will return a Unix timestamp
     *
     * @return mixed Unix timestamp, a preformated date-string or PEAR::Error
     * @see Client::ERR_MDTMDIR_UNSUPPORTED, self::ERR_MDTM_FAILED,
     *      self::ERR_DATEFORMAT_FAILED
     */
    public function mdtm($file, $format = null)
    {
        $file = $this->constructPath($file);
        if ($this->checkRemoteDir($file) !== false) {
            throw new \RuntimeException("Filename '$file' seems to be a directory.",
                self::ERR_MDTMDIR_UNSUPPORTED);
        }
        $res = @ftp_mdtm($this->handle, $file);
        if ($res == -1) {
            throw new \RuntimeException("Could not get last-modification-date of '" .
                $file . "'.", self::ERR_MDTM_FAILED);
        }
        if (isset($format)) {
            $res = date($format, $res);
            if (!$res) {
                throw new \RuntimeException("Date-format failed on timestamp '" . $res .
                    "'.", self::ERR_DATEFORMAT_FAILED);
            }
        }
        return $res;
    }

    /**
     * Checks whether the given path is a remote directory by trying to
     * chdir() into it (and back out)
     *
     * @param string $path Path to check
     *
     * @return bool if $path is a directory, otherwise false
     * @throws \RuntimeException
     */
    private function checkRemoteDir(string $path): bool
    {
        $pwd = $this->pwd();
        try {
            $this->cd($path);
        } catch (\RuntimeException $e) {
            if ($e->getCode() === self::ERR_DIRCHANGE_FAILED) {
                return false;
            }
        }
        $this->cd($pwd);

        return true;
    }

    /**
     * Show's you the actual path on the server
     * This function questions the ftp-handle for the actual selected path and
     * returns it.
     *
     * @return string|false
     */
    public function pwd()
    {
        $res = @ftp_pwd($this->handle);
        if (!$res) {
            throw new \RuntimeException("Could not determine the actual path.", self::ERR_DETERMINEPATH_FAILED);
        }

        return $res;
    }

    /**
     * This changes the currently used directory. You can use either an absolute
     * directory-path (e.g. "/home/blah") or a relative one (e.g. "../test").
     *
     * @param string $dir The directory to go to.
     *
     * @return true on success
     * @see Client::ERR_DIRCHANGE_FAILED
     */
    public function cd(string $dir): bool
    {
        $erg = @ftp_chdir($this->handle, $dir);
        if (!$erg) {
            throw new \RuntimeException("Directory change failed", self::ERR_DIRCHANGE_FAILED);
        }

        return true;
    }

    /**
     * This will return the size of a given file in bytes. You can either give this
     * function a relative or an absolute file-path. NOTE: Some servers do not
     * support this feature!
     *
     * @param string $file The file to check
     *
     * @return mixed Size in bytes or PEAR::Error
     * @see Client::ERR_SIZE_FAILED
     */
    public function size($file)
    {
        $file = $this->constructPath($file);
        $res = @ftp_size($this->handle, $file);
        if ($res === -1) {
            throw new \RuntimeException("Could not determine filesize of '$file'.", self::ERR_SIZE_FAILED);
        }

        return $res;
    }

    /**
     * This method will delete the given file or directory ($path) from the server
     * (maybe recursive).
     *
     * Whether the given string is a file or directory is only determined by the
     * last sign inside the string ("/" or not).
     *
     * If you specify a directory, you can optionally specify $recursive as true,
     * to let the directory be deleted recursive (with all sub-directories and files
     * inherited).
     *
     * You can either give a absolute or relative path for the file / dir. If you
     * choose to use the relative path, it will be automatically completed with the
     * actual selected directory.
     *
     * @param string $path The absolute or relative path to the file/directory.
     * @param bool $recursive Recursively delete everything in $path
     * @param bool $filesonly When deleting recursively, only delete files so the
     *                          directory structure is preserved
     *
     * @return true on success
     * @see Client::ERR_DELETEFILE_FAILED, self::ERR_DELETEDIR_FAILED,
     *      self::ERR_REMOTEPATHNODIR
     */
    public function rm($path, $recursive = false, $filesonly = false): bool
    {
        $path = $this->constructPath($path);
        if ($this->checkRemoteDir($path) === true) {
            if ($recursive) {
                return $this->rmDirRecursive($path, $filesonly);
            }

            return $this->rmDir($path);
        }

        return $this->rmFile($path);
    }

    /**
     * This will remove a dir and all subdirs and -files
     *
     * @param string $dir The dir to delete recursively
     * @param bool $filesonly Only delete files so the directory structure is
     *                          preserved
     *
     * @return true on success
     * @see Client::ERR_REMOTEPATHNODIR, self::ERR_DELETEDIR_FAILED
     */
    private function rmDirRecursive(string $dir, bool $filesonly = false)
    {
        if (substr($dir, (strlen($dir) - 1), 1) !== "/") {
            throw new \RuntimeException("Directory name '" . $dir .
                "' is invalid, has to end with '/'",
                self::ERR_REMOTEPATHNODIR);
        }
        $file_list = $this->lsFiles($dir);
        foreach ($file_list as $file) {
            $file = $dir . $file["name"];
            $this->rm($file);
        }

        $dir_list = $this->lsDirs($dir);
        foreach ($dir_list as $new_dir) {
            if ($new_dir["name"] === '.' || $new_dir["name"] === '..') {
                continue;
            }
            $new_dir = $dir . $new_dir["name"] . "/";
            $this->rmDirRecursive($new_dir, $filesonly);
        }
        if (!$filesonly) {
            $this->rmDir($dir);
        }

        return true;
    }

    /**
     * This will remove a dir
     *
     * @param string $dir The dir to delete
     *
     * @return true on success
     * @see Client::ERR_REMOTEPATHNODIR, self::ERR_DELETEDIR_FAILED
     */
    private function rmDir(string $dir): bool
    {
        if (substr($dir, (strlen($dir) - 1), 1) !== "/") {
            throw new \RuntimeException("Directory name '" . $dir .
                "' is invalid, has to end with '/'",
                self::ERR_REMOTEPATHNODIR);
        }
        $res = @ftp_rmdir($this->handle, $dir);
        if (!$res) {
            throw new \RuntimeException("Could not delete directory '$dir'.",
                self::ERR_DELETEDIR_FAILED);
        }

        return true;
    }

    /**
     * This will remove a file
     *
     * @param string $file The file to delete
     *
     * @return true on success
     * @see Client::ERR_DELETEFILE_FAILED
     */
    private function rmFile(string $file): bool
    {
        if (substr($file, 0, 1) !== "/") {
            $actual_dir = @ftp_pwd($this->handle);
            if (substr($actual_dir, (strlen($actual_dir) - 2), 1) !== "/") {
                $actual_dir .= "/";
            }
            $file = $actual_dir . $file;
        }
        $res = @ftp_delete($this->handle, $file);

        if (!$res) {
            throw new \RuntimeException("Could not delete file '$file'.", self::ERR_DELETEFILE_FAILED);
        }

        return true;
    }

    /**
     * This functionality allows you to transfer a whole directory-structure from
     * the remote-ftp to your local host. You have to give a remote-directory
     * (ending with '/') and the local directory (ending with '/') where to put the
     * files you download.
     * The remote path is automatically completed with the current-remote-dir, if
     * you give a relative path to this function. You can give a relative path for
     * the $local_path, too. Then the script-basedir will be used for comletion of
     * the path.
     * The parameter $overwrite will determine, whether to overwrite existing files
     * or not. Standard for this is false. Fourth you can explicitly set a mode for
     * all transfer actions done. If you do not set this, the method tries to
     * determine the transfer mode by checking your mode-directory for the file
     * extension. If the extension is not inside the mode-directory, it will get
     * your default mode.
     *
     * Since 1.4 no error will be returned when a file exists while $overwrite is
     * set to false.
     *
     * @param string $remote_path The path to download
     * @param string $local_path The path to download to
     * @param bool $overwrite (optional) Whether to overwrite existing files
     *                            (true) or not (false, standard).
     * @param int $mode (optional) The transfermode (either FTP_ASCII or
     *                            FTP_BINARY).
     * @param array $excluded_paths (optional) List of remote files or directories to
     *                               exclude from the transfer. All files and
     *                               directories must be stated as absolute paths.
     *                               Note: You must include a trailing slash on directory names.
     *
     * @return true on succes
     *
     * @see Client::ERR_OVERWRITELOCALFILE_FORBIDDEN,
     * @see Client::ERR_OVERWRITELOCALFILE_FAILED, self::ERR_OVERWRITELOCALFILE_FAILED,
     * @see Client::ERR_REMOTEPATHNODIR, self::ERR_LOCALPATHNODIR,
     * @see Client::ERR_CREATELOCALDIR_FAILED
     */
    public function getRecursive($remote_path, $local_path, $overwrite = false, $mode = null, $excluded_paths = [])
    {
        $remote_path = $this->constructPath($remote_path);
        if ($this->checkRemoteDir($remote_path) !== true) {
            throw new \RuntimeException("Given remote-path '" . $remote_path .
                "' seems not to be a directory.",
                self::ERR_REMOTEPATHNODIR);
        }

        if (!@file_exists($local_path)) {
            $res = @mkdir($local_path);
            if (!$res) {
                throw new \RuntimeException("Could not create dir '$local_path'",
                    self::ERR_CREATELOCALDIR_FAILED);
            }
        } elseif (!@is_dir($local_path)) {
            throw new \RuntimeException("Given local-path '" . $local_path .
                "' seems not to be a directory.",
                self::ERR_LOCALPATHNODIR);
        }

        $dir_list = $this->ls($remote_path, self::DIRS_ONLY);
        foreach ($dir_list as $dir_entry) {
            if ($dir_entry['name'] !== '.' && $dir_entry['name'] !== '..') {
                $remote_path_new = $remote_path . $dir_entry["name"] . "/";
                $local_path_new = $local_path . $dir_entry["name"] . "/";

                // Check whether the directory should be excluded
                if (!in_array($remote_path_new, $excluded_paths)) {
                    $this->getRecursive($remote_path_new, $local_path_new, $overwrite, $mode);
                }
            }
        }
        $file_list = $this->ls($remote_path, self::FILES_ONLY);
        foreach ($file_list as $file_entry) {
            $remote_file = $remote_path . $file_entry["name"];
            $local_file = $local_path . $file_entry["name"];

            // Check whether the file should be excluded
            if (!in_array($remote_file, $excluded_paths)) {
                try {
                    $this->get($remote_file, $local_file, $overwrite, $mode);
                } catch (\RuntimeException $e) {
                    if ($e->getCode() !== self::ERR_OVERWRITELOCALFILE_FORBIDDEN) {
                        throw $e;
                    }
                }
            }
        }
        return true;
    }

    /**
     * This function will download a file from the ftp-server. You can either
     * specify an absolute path to the file (beginning with "/") or a relative one,
     * which will be completed with the actual directory you selected on the server.
     * You can specify the path to which the file will be downloaded on the local
     * machine, if the file should be overwritten if it exists (optionally, default
     * is no overwriting) and in which mode (FTP_ASCII or FTP_BINARY) the file
     * should be downloaded (if you do not specify this, the method tries to
     * determine it automatically from the mode-directory or uses the default-mode,
     * set by you).
     * If you give a relative path to the local-file, the script-path is used as
     * basepath.
     *
     * @param string $remote_file The absolute or relative path to the file to
     *                            download
     * @param string $local_file The local file to put the downloaded in
     * @param bool $overwrite (optional) Whether to overwrite existing file
     * @param int $mode (optional) Either FTP_ASCII or FTP_BINARY
     *
     * @return true on success
     * @see Client::ERR_OVERWRITELOCALFILE_FORBIDDEN,
     *      self::ERR_OVERWRITELOCALFILE_FAILED,
     *      self::ERR_OVERWRITELOCALFILE_FAILED
     */
    public function get($remote_file, $local_file, $overwrite = false, $mode = null)
    {
        if (!isset($mode)) {
            $mode = $this->checkFileExtension($remote_file);
        }

        $remote_file = $this->constructPath($remote_file);

        if (@file_exists($local_file) && !$overwrite) {
            throw new \RuntimeException("Local file '" . $local_file .
                "' exists and may not be overwriten.",
                self::ERR_OVERWRITELOCALFILE_FORBIDDEN);
        }
        if (@file_exists($local_file) && !@is_writable($local_file) && $overwrite) {
            throw new \RuntimeException("Local file '" . $local_file .
                "' is not writeable. Can not overwrite.",
                self::ERR_OVERWRITELOCALFILE_FAILED);
        }

        if (@function_exists('ftp_nb_get')) {
            $res = @ftp_nb_get($this->handle, $local_file, $remote_file, $mode);
            while ($res === FTP_MOREDATA) {
                $this->announce('nb_get');
                $res = @ftp_nb_continue($this->handle);
            }
        } else {
            $res = @ftp_get($this->handle, $local_file, $remote_file, $mode);
        }
        if (!$res) {
            throw new \RuntimeException("File '" . $remote_file .
                "' could not be downloaded to '$local_file'.",
                self::ERR_OVERWRITELOCALFILE_FAILED);
        }

        return true;
    }

    /**
     * This checks, whether a file should be transfered in ascii- or binary-mode
     * by it's file-extension. If the file-extension is not set or
     * the extension is not inside one of the extension-dirs, the actual set
     * transfer-mode is returned.
     *
     * @param string $filename The filename to be checked
     *
     * @return int Either FTP_ASCII or FTP_BINARY
     */
    public function checkFileExtension(string $filename): int
    {
        if (($pos = strrpos($filename, '.')) === false) {
            return $this->mode;
        }

        $ext = substr($filename, $pos + 1);

        return $this->fileExtensions[$ext] ?? $this->mode;
    }

    /**
     * Informs each registered observer instance that a new message has been
     * sent.
     *
     * @param mixed $event A hash describing the net event.
     *
     * @return void
     * @since 1.3
     */
    private function announce($event): void
    {
        foreach ($this->listeners as $listener) {
            $listener->setEvent($event);
            $listener->notify($event);
        }
    }

    /**
     * This functionality allows you to transfer a whole directory-structure from
     * your local host to the remote-ftp. You have to give a remote-directory
     * (ending with '/') and the local directory (ending with '/') where to put the
     * files you download. The remote path is automatically completed with the
     * current-remote-dir, if you give a relative path to this function. You can
     * give a relative path for the $local_path, too. Then the script-basedir will
     * be used for comletion of the path.
     * The parameter $overwrite will determine, whether to overwrite existing files
     * or not.
     * Standard for this is false. Fourth you can explicitly set a mode for all
     * transfer actions done. If you do not set this, the method tries to determine
     * the transfer mode by checking your mode-directory for the file-extension. If
     * the extension is not inside the mode-directory, it will get your default
     * mode.
     *
     * @param string $local_path The path to download to
     * @param string $remote_path The path to download
     * @param bool $overwrite (optional) Whether to overwrite existing files
     *                               (true) or not (false, standard).
     * @param int $mode (optional) The transfermode (either FTP_ASCII or
     *                               FTP_BINARY).
     * @param array $excluded_paths (optional) List of local files or directories to
     *                               exclude from the transfer. All files and
     *                               directories must be stated as absolute paths.
     *                               Note: You must include a trailing slash on
     *                               directory names.
     *
     * @return true on succes
     * @see Client::ERR_LOCALFILENOTEXIST,
     * @see self::ERR_OVERWRITEREMOTEFILE_FORBIDDEN,
     * @see self::ERR_UPLOADFILE_FAILED, self::ERR_LOCALPATHNODIR,
     * @see self::ERR_REMOTEPATHNODIR
     */
    public function putRecursive(
        $local_path,
        $remote_path,
        $overwrite = false,
        $mode = null,
        $excluded_paths = []
    ): bool {
        $remote_path = $this->constructPath($remote_path);
        if (!file_exists($local_path) || !is_dir($local_path)) {
            throw new \RuntimeException("Given local-path '" . $local_path .
                "' seems not to be a directory.", self::ERR_LOCALPATHNODIR);
        }
        // try to create directory if it doesn't exist
        $old_path = $this->pwd();

        try {
            $this->cd($remote_path);
        } catch (\RuntimeException $e) {
            $this->mkdir($remote_path);
        }
        $this->cd($old_path);
        if ($this->checkRemoteDir($remote_path) !== true) {
            throw new \RuntimeException("Given remote-path '" . $remote_path .
                "' seems not to be a directory.",
                self::ERR_REMOTEPATHNODIR);
        }
        $dir_list = $this->lsLocal($local_path);
        foreach ($dir_list["dirs"] as $dir_entry) {
            // local directories do not have arrays as entry
            $remote_path_new = $remote_path . $dir_entry . "/";
            $local_path_new = $local_path . $dir_entry . "/";

            // Check whether the directory should be excluded
            if (!in_array($local_path_new, $excluded_paths)) {
                $this->putRecursive($local_path_new, $remote_path_new, $overwrite, $mode, $excluded_paths);
            }
        }

        foreach ($dir_list["files"] as $file_entry) {
            $remote_file = $remote_path . $file_entry;
            $local_file = $local_path . $file_entry;

            // Check whether the file should be excluded
            if (!in_array($local_file, $excluded_paths)) {
                $this->put($local_file, $remote_file, $overwrite, $mode);
            }
        }
        return true;
    }

    /**
     * This works similar to the mkdir-command on your local machine. You can either
     * give it an absolute or relative path. The relative path will be completed
     * with the actual selected server-path. (see: pwd())
     *
     * @param string $dir Absolute or relative dir-path
     * @param bool $recursive (optional) Create all needed directories
     *
     * @return bool true on success
     * @see Client::ERR_CREATEDIR_FAILED
     */
    public function mkdir($dir, $recursive = false): bool
    {
        $dir = $this->constructPath($dir);
        $savedir = $this->pwd();
        // $this->pushErrorHandling(PEAR_ERROR_RETURN);
        $e = $this->cd($dir);
        // $this->popErrorHandling();
        if ($e === true) {
            $this->cd($savedir);
            return true;
        }
        $this->cd($savedir);
        if ($recursive === false) {
            $res = @ftp_mkdir($this->handle, $dir);
            if (!$res) {
                throw new \RuntimeException("Creation of '$dir' failed", self::ERR_CREATEDIR_FAILED);
            }

            return true;
        }

        // do not look at the first character, as $dir is absolute,
        // it will always be a /
        if (strpos(substr($dir, 1), '/') === false) {
            return $this->mkdir($dir, false);
        }
        if (substr($dir, -1) === '/') {
            $dir = substr($dir, 0, -1);
        }
        $parent = substr($dir, 0, strrpos($dir, '/'));
        $res = $this->mkdir($parent, true);
        if ($res === true) {
            $res = $this->mkdir($dir, false);
        }
        if ($res !== true) {
            return $res;
        }
        return true;
    }

    /**
     * Lists a local directory
     *
     * @param string $dir_path The dir to list
     *
     * @return array The list of dirs and files
     */
    private function lsLocal($dir_path): array
    {
        $dir = dir($dir_path);
        $dir_list = array();
        $file_list = array();
        while (false !== ($entry = $dir->read())) {
            if (($entry !== '.') && ($entry !== '..')) {
                if (is_dir($dir_path . $entry)) {
                    $dir_list[] = $entry;
                } else {
                    $file_list[] = $entry;
                }
            }
        }
        $dir->close();
        $res['dirs'] = $dir_list;
        $res['files'] = $file_list;
        return $res;
    }

    /**
     * This function will upload a file to the ftp-server. You can either specify a
     * absolute path to the remote-file (beginning with "/") or a relative one,
     * which will be completed with the actual directory you selected on the server.
     * You can specify the path from which the file will be uploaded on the local
     * maschine, if the file should be overwritten if it exists (optionally, default
     * is no overwriting) and in which mode (FTP_ASCII or FTP_BINARY) the file
     * should be downloaded (if you do not specify this, the method tries to
     * determine it automatically from the mode-directory or uses the default-mode,
     * set by you).
     * If you give a relative path to the local-file, the script-path is used as
     * basepath.
     *
     * @param string $local_file The local file to upload
     * @param string $remote_file The absolute or relative path to the file to
     *                            upload to
     * @param bool $overwrite (optional) Whether to overwrite existing file
     * @param int $mode (optional) Either FTP_ASCII or FTP_BINARY
     * @param int $options (optional) Flags describing the behaviour of this
     *                            function. Currently self::BLOCKING and
     *                            self::NONBLOCKING are supported, of which
     *                            self::NONBLOCKING is the default.
     *
     * @return true on success
     * @see Client::ERR_LOCALFILENOTEXIST
     * @see Client::ERR_OVERWRITEREMOTEFILE_FORBIDDEN
     * @see Client::ERR_UPLOADFILE_FAILED, Client::NONBLOCKING, Client::BLOCKING
     */
    public function put($local_file, $remote_file, $overwrite = false, $mode = null, $options = 0)
    {
        if ($options & (self::BLOCKING | self::NONBLOCKING) === (self::BLOCKING | self::NONBLOCKING)) {
            throw new \RuntimeException('Bad options given: self::NONBLOCKING and ' .
                'self::BLOCKING can\'t both be set',
                self::ERR_BADOPTIONS);
        }

        $usenb = !($options & (self::BLOCKING === self::BLOCKING));

        if (!isset($mode)) {
            $mode = $this->checkFileExtension($local_file);
        }
        $remote_file = $this->constructPath($remote_file);

        if (!@file_exists($local_file)) {
            throw new \RuntimeException("Local file '$local_file' does not exist.",
                self::ERR_LOCALFILENOTEXIST);
        }
        if ((@ftp_size($this->handle, $remote_file) !== -1) && !$overwrite) {
            throw new \RuntimeException("Remote file '" . $remote_file .
                "' exists and may not be overwriten.",
                self::ERR_OVERWRITEREMOTEFILE_FORBIDDEN);
        }

        if (function_exists('ftp_alloc')) {
            ftp_alloc($this->handle, filesize($local_file));
        }
        if ($usenb && function_exists('ftp_nb_put')) {
            $res = @ftp_nb_put($this->handle, $remote_file, $local_file, $mode);
            while ($res === FTP_MOREDATA) {
                $this->announce('nb_put');
                $res = @ftp_nb_continue($this->handle);
            }

        } else {
            $res = @ftp_put($this->handle, $remote_file, $local_file, $mode);
        }
        if (!$res) {
            throw new \RuntimeException("File '$local_file' could not be uploaded to '"
                . $remote_file . "'.",
                self::ERR_UPLOADFILE_FAILED);
        }

        return true;
    }

    /**
     * Adds an extension to a mode-directory
     *
     * The mode-directory saves file-extensions coresponding to filetypes
     * (ascii e.g.: 'php', 'txt', 'htm',...; binary e.g.: 'jpg', 'gif', 'exe',...).
     * The extensions have to be saved without the '.'. And
     * can be predefined in an external file (see: getExtensionsFile()).
     *
     * The array is build like this: 'php' => FTP_ASCII, 'png' => FTP_BINARY
     *
     * To change the mode of an extension, just add it again with the new mode!
     *
     * @param int $mode Either FTP_ASCII or FTP_BINARY
     * @param string $ext Extension
     *
     * @return void
     */
    public function addExtension($mode, $ext): void
    {
        $this->fileExtensions[$ext] = $mode;
    }

    /**
     * This function removes an extension from the mode-directories
     * (described above).
     *
     * @param string $ext The extension to remove
     *
     * @return void
     */
    public function removeExtension(string $ext): void
    {
        if (isset($this->fileExtensions[$ext])) {
            unset($this->fileExtensions[$ext]);
        }
    }

    /**
     * This get's both (ascii- and binary-mode-directories) from the given file.
     * Beware, if you read a file into the mode-directory, all former set values
     * will be unset!
     *
     * Example file contents:
     * [ASCII]
     * asc = 0
     * txt = 0
     * [BINARY]
     * bin = 1
     * jpg = 1
     *
     * @param string $filename The file to get from
     *
     * @return true on success
     * @see Client::ERR_EXTFILENOTEXIST, self::ERR_EXTFILEREAD_FAILED
     */
    public function getExtensionsFile($filename)
    {
        if (!file_exists($filename)) {
            throw new \RuntimeException("Extensions-file '$filename' does not exist",
                self::ERR_EXTFILENOTEXIST);
        }

        if (!is_readable($filename)) {
            throw new \RuntimeException("Extensions-file '$filename' is not readable",
                self::ERR_EXTFILEREAD_FAILED);
        }

        $exts = @parse_ini_file($filename, true);
        if (!is_array($exts)) {
            throw new \RuntimeException("Extensions-file '$filename' could not be" .
                "loaded", self::ERR_EXTFILELOAD_FAILED);
        }

        $this->fileExtensions = [];

        if (isset($exts['ASCII'])) {
            foreach (array_keys($exts['ASCII']) as $ext) {
                $this->fileExtensions[$ext] = FTP_ASCII;
            }
        }

        if (isset($exts['BINARY'])) {
            foreach (array_keys($exts['BINARY']) as $ext) {
                $this->fileExtensions[$ext] = FTP_BINARY;
            }
        }

        return true;
    }

    /**
     * Returns the transfermode
     *
     * @return int The transfermode, either FTP_ASCII or FTP_BINARY.
     */
    public function getMode(): int
    {
        return $this->mode;
    }

    /**
     * Set the transfer-mode. You can use the predefined constants
     * FTP_ASCII or FTP_BINARY. The mode will be stored for any further transfers.
     *
     * @param int $mode The mode to set
     *
     * @return true on success
     * @see Client::ERR_NOMODECONST
     */
    public function setMode(int $mode): bool
    {
        if (($mode === FTP_ASCII) || ($mode === FTP_BINARY)) {
            $this->mode = $mode;
            return true;
        }

        throw new \RuntimeException('FTP-Mode has either to be FTP_ASCII or FTP_BINARY', self::ERR_NOMODECONST);
    }

    /**
     * Returns, whether the connection is set to passive mode or not
     *
     * @return bool True if passive-, false if active-mode
     */
    public function isPassive(): bool
    {
        return $this->passv;
    }

    /**
     * Returns the mode set for a file-extension
     *
     * @param string $ext The extension you wanna ask for
     *
     * @return int Either FTP_ASCII, FTP_BINARY or NULL (if not set a mode for it)
     */
    public function getExtensionMode(string $ext): ?int
    {
        return $this->fileExtensions[$ext] ?? null;
    }

    /**
     * Get the currently set timeout.
     * Returns the actual timeout set.
     *
     * @return int The actual timeout
     */
    public function getTimeout(): int
    {
        return ftp_get_option($this->handle, FTP_TIMEOUT_SEC);
    }

    /**
     * Set the timeout for FTP operations
     *
     * Use this method to set a timeout for FTP operation. Timeout has to be an
     * integer.
     *
     * @param int $timeout the timeout to use
     *
     * @return bool True on success
     * @see Client::ERR_TIMEOUTLESSZERO, self::ERR_SETTIMEOUT_FAILED
     */
    public function setTimeout($timeout = 0): bool
    {
        if (!is_int($timeout) || ($timeout < 0)) {
            throw new \RuntimeException('Timeout ' . $timeout . ' is invalid, has to be an integer >= 0',
                self::ERR_TIMEOUTLESSZERO);
        }
        $this->timeout = $timeout;
        if (isset($this->handle) && is_resource($this->handle)) {
            $res = @ftp_set_option($this->handle, FTP_TIMEOUT_SEC, $timeout);
        } else {
            $res = true;
        }
        if (!$res) {
            throw new \RuntimeException("Set timeout failed.", self::ERR_SETTIMEOUT_FAILED);
        }
        return true;
    }

    /**
     * Adds a Net_FTP_Observer instance to the list of observers
     * that are listening for messages emitted by this Net_FTP instance.
     *
     * @param \SplObserver $observer The Net_FTP_Observer instance to attach
     *                         as a listener.
     *
     * @return boolean True if the observer is successfully attached.
     */
    public function attach(\SplObserver $observer): bool
    {
        if (!$observer instanceof \Observer) {
            return false;
        }

        $this->listeners[$observer->getId()] = &$observer;
        return true;
    }

    /**
     * Removes a Net_FTP_Observer instance from the list of observers.
     *
     * @param \SplObserver|\Observer $observer The Net_FTP_Observer instance to detach
     *                         from the list of listeners.
     *
     * @return boolean True if the observer is successfully detached.
     */
    public function detach(\SplObserver $observer): bool
    {
        if (!$observer instanceof \Observer || !isset($this->listeners[$observer->getId()])) {
            return false;
        }

        unset($this->listeners[$observer->getId()]);
        return true;
    }

    /**
     * Sets the directory listing matcher
     *
     * Use this method to set the directory listing matcher to a specific pattern.
     * Indicate the pattern as a perl regular expression and give an array
     * containing as keys the fields selected in the regular expression and as
     * values the offset of the subpattern in the pattern.
     *
     * Example:
     * $pattern = '/(?:(d)|.)([rwxt-]+)\s+(\w+)\s+([\w\d-]+)\s+([\w\d-]+)\s+(\w+)
     *             \s+(\S+\s+\S+\s+\S+)\s+(.+)/',
     * $matchmap = array(
     *     'is_dir'        => 1,
     *     'rights'        => 2,
     *     'files_inside'  => 3,
     *     'user'          => 4,
     *     'group'         => 5,
     *     'size'          => 6,
     *     'date'          => 7,
     *     'name'          => 8,
     * )
     *
     * Make sure at least the is_dir and name keys are set. The is_dir key should
     * point to a subpattern that is empty for non-directories and non-empty
     * for directories.
     *
     * @param string $pattern The new matcher pattern to use
     * @param array $matchmap An mapping from key to subpattern offset
     *
     * @return bool True if matcher set successfully, PEAR_Error otherwise
     *
     * @see Client::ERR_ILLEGALPATTERN,
     * @see Client::ERR_ILLEGALMAP
     * @see Client::ERR_ILLEGALMAPVALUE
     */
    public function setDirMatcher($pattern, $matchmap): bool
    {
        if (!is_string($pattern)) {
            throw new \RuntimeException('The supplied pattern is not a string', self::ERR_ILLEGALPATTERN);
        }
        if (!is_array($matchmap)) {
            throw new \RuntimeException('The supplied pattern is not an array', self::ERR_ILLEGALMAP);
        }

        foreach ($matchmap as $val) {
            if (!is_numeric($val)) {
                throw new \RuntimeException('The supplied pattern contains invalid value ' . $val,
                    self::ERR_ILLEGALMAPVALUE);
            }
        }

        $this->matcher = ['pattern' => $pattern, 'map' => $matchmap];

        return true;
    }

    /**
     * Function for use with usort().
     * Compares the list-array-elements by name.
     *
     * @param array $item_1 first item to be compared
     * @param array $item_2 second item to be compared
     *
     * @return int < 0 if $item_1 is less than $item_2, 0 if equal and > 0 otherwise
     */
    private function natSort($item_1, $item_2): int
    {
        return strnatcmp($item_1['name'], $item_2['name']);
    }
}
