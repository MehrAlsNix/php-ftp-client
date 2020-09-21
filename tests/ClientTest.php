<?php

namespace MehrAlsNix\PhpFtp\Tests;

use MehrAlsNix\PhpFtp\Client;
use PHPUnit\Framework\TestCase;

/**
 * Class ClientTest
 * @package MehrAlsNix\PhpFtp
 */
class ClientTest extends TestCase
{
    protected $ftp;
    protected $ftpdir;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     * @return void
     */
    protected function setUp(): void
    {
        if (!file_exists(__DIR__ . '/config.php')) {
            $this->markTestSkipped('config.php does not exist in '.getcwd());
        }

        include_once 'config.php';

        if (!defined('FTPHOST') || !defined('FTPPORT') || !defined('FTPUSER')
            || !defined('FTPPASSWORD')) {
            $this->markTestSkipped('Some required constants are not defined');
        }

        $this->ftp = new Client(FTPHOST, FTPPORT, 30);

        try {
            $res = $this->ftp->login(FTPUSER, FTPPASSWORD);
        } catch (\RuntimeException $e) {
            $this->markTestSkipped('Could not login to the FTP server');
        }

        if (defined('FTPDIR') && '' !== FTPDIR) {
            try {
                $this->ftp->cd(FTPDIR);
            } catch (\RuntimeException $e) {
                $this->markTestSkipped('Could switch to directory '.FTPDIR);
            }
        }

        try {
            $this->ftpdir = $this->ftp->pwd();
        } catch (\RuntimeException $e) {
            $this->markTestSkipped('Could not get current directory');
        }

        try {
            $this->ftp->mkdir('test');
        } catch (\RuntimeException $e) {
            $this->markTestSkipped('Could not create a test directory');
        }

        try {
            $this->ftp->cd('test');
        } catch (\RuntimeException $e) {
            $this->markTestSkipped('Could not change to the test directory');
        }
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @access protected
     * @return void
     */
    protected function tearDown(): void
    {
        if ($this->ftp !== null) {
            $this->ftp->cd($this->ftpdir);
            $this->ftp->rm('test/', true);
            $this->ftp->disconnect();

            $this->ftpdir     = null;
            $this->ftp        = null;
        }
    }

    /**
     * Tests functionality of Net_FTP::mkdir()
     *
     * @see Client::mkdir()
     */
    public function testMkdir(): void
    {
        $this->ftp->mkdir('dir1', false);
        $this->ftp->mkdir('dir1/dir2/dir3/dir4', true);
        $this->assertTrue($this->ftp->cd('dir1/dir2/dir3/dir4'));
    }

    /**
     * Tests functionality of Net_FTP::mkdir()
     *
     * @return void
     * @see Net_FTP::mkdir()
     */
    public function testRename()
    {
        $this->ftp->put('testfile.dat', 'testfile.dat', FTP_ASCII);
        $this->assertTrue($this->ftp->rename('testfile.dat', 'testfile2.dat'));
    }

    /**
     * Tests functionality of Net_FTP::rm()
     *
     * @return void
     * @see Net_FTP::rm()
     */
    public function testRm()
    {
        $list1 = $this->ftp->ls();

        $this->ftp->put('testfile.dat', 'testfile.dat', FTP_ASCII);
        $this->ftp->mkdir('dir1/dir2/dir3/dir4', true);

        $this->ftp->rm('dir1/', true);
        $this->ftp->rm('testfile.dat');

        $list2 = $this->ftp->ls();

        $this->assertEquals($list1, $list2, 'Directory listing before creation and'.
            ' after creation are not equal');

        $this->ftp->mkdir('dir1');
        $this->ftp->cd('dir1');
        $this->ftp->mkdir('dir1');
        $this->ftp->mkdir('dir2');
        $this->ftp->mkdir('dir3');
        $this->ftp->put('testfile.dat', 'testfile.dat', FTP_ASCII);

        $this->ftp->cd('..');

        $this->ftp->rm('dir1/', true, true);

        $this->ftp->cd('dir1');

        $list = $this->_getNames($this->ftp->ls());
        $dirs = array('dir1', 'dir2', 'dir3');

        sort($list);
        sort($dirs);

        $this->assertEquals($list, $dirs, 'The resulting directory listing is not '.
            'correct');
    }

    /**
     * Tests functionality of Net_FTP::putRecursive()
     *
     * @return void
     * @see Net_FTP::putRecursive()
     */
    public function testPutRecursive()
    {
        $tmpdir    = array();
        $tmpfile   = array();
        $tmpdir[]  = System::mktemp(array('-d', 'pearnetftptest'));
        $tmpdir[]  = System::mktemp(array('-t', $tmpdir[0], '-d'));
        $tmpdir[]  = System::mktemp(array('-t', $tmpdir[1], '-d'));
        $tmpfile[] = System::mktemp(array('-t', $tmpdir[0]));
        $tmpfile[] = System::mktemp(array('-t', $tmpdir[1]));
        $tmpfile[] = System::mktemp(array('-t', $tmpdir[2]));

        $local  = $tmpdir[0].DIRECTORY_SEPARATOR;
        $remote = './'.$this->_getLastPart($tmpdir[0]).'/';

        $ret = $this->ftp->putRecursive($local, $remote);
        $this->assertFalse(PEAR::isError($ret));

        for ($i = 0; $i < 3; $i++) {
            $ret = $this->ftp->cd($this->_getLastPart($tmpdir[$i]).'/');
            $this->assertFalse(PEAR::isError($ret));

            $dirlist = $this->ftp->ls();
            $this->assertFalse(PEAR::isError($dirlist));

            $dirlist   = $this->_getNames($dirlist);
            $dirlistok = array($this->_getLastPart($tmpfile[$i]));
            if ($i < 2) {
                $dirlistok[] = $this->_getLastPart($tmpdir[$i+1]);
            }

            sort($dirlist);
            sort($dirlistok);

            $this->assertEquals($dirlist, $dirlistok);
        }
    }

    /**
     * Tests functionality of Net_FTP::put()
     *
     * @return void
     * @see Net_FTP::put()
     */
    public function testPut()
    {
        $res = $this->ftp->put('testfile.dat', 'testfile.dat', true, FTP_ASCII,
            NET_FTP_BLOCKING | NET_FTP_NONBLOCKING);
        $this->assertTrue(PEAR::isError($res), 'No error return while it should');
        if (PEAR::isError($res)) {
            $this->assertEquals($res->getCode(), NET_FTP_ERR_BADOPTIONS,
                'Bad error code returned');
        }
    }

    /**
     * Tests functionality of Net_FTP::_makeDirPermissions()
     *
     * @return void
     * @see Net_FTP::_makeDirPermissions()
     */
    public function testMakeDirPermissions()
    {
        $tests = array(
            '111' => '111',
            '110' => '110',
            '444' => '555',
            '412' => '512',
            '641' => '751',
            '666' => '777',
            '400' => '500',
            '040' => '050',
            '004' => '005',
        );

        foreach ($tests AS $in => $out) {
            $this->assertEquals($this->ftp->_makeDirPermissions($in), $out);
        }
    }

    /**
     * Tests functionality of Net_FTP::size()
     *
     * @return void
     * @see Net_FTP::size()
     */
    public function testSize()
    {
        // upload in binary to avoid addition/removal of characters
        $this->ftp->put('testfile.dat', 'testfile.dat', FTP_BINARY);
        $this->assertEquals($this->ftp->size('testfile.dat'),
            filesize('testfile.dat'));
    }

    /**
     * Tests functionality of Net_FTP::setMode(), Net_FTP::checkFileExtension(),
     * Net_FTP::addExtension() and Net_FTP::removeExtension()
     *
     * @return void
     * @see Net_FTP::checkFileExtension(), Net_FTP::addExtension(),
     *      Net_FTP::removeExtension(), Net_FTP::setMode()
     */
    public function testExtensions()
    {
        $this->ftp->setMode(FTP_ASCII);
        $this->ftp->addExtension(FTP_BINARY, 'tst');
        $this->assertEquals($this->ftp->checkFileExtension('test.tst'), FTP_BINARY);
        $this->ftp->removeExtension('tst');
        $this->assertEquals($this->ftp->checkFileExtension('test.tst'), FTP_ASCII);
        $this->ftp->setMode(FTP_BINARY);
        $this->assertEquals($this->ftp->checkFileExtension('test.tst'), FTP_BINARY);
    }

    /**
     * Tests functionality of Net_FTP::getExtensionsFile()
     *
     * @return void
     * @see Net_FTP::getExtensionsFile()
     */
    public function testGetExtensionsFile()
    {
        $res = $this->ftp->getExtensionsFile('extensions.ini');
        $this->assertFalse(PEAR::isError($res), 'Test extensions file could be'.
            'loaded');

        $this->ftp->setMode(FTP_BINARY);
        $this->assertEquals($this->ftp->checkFileExtension('test.asc'), FTP_ASCII);
        $this->ftp->setMode(FTP_ASCII);
        $this->assertEquals($this->ftp->checkFileExtension('test.gif'), FTP_BINARY);
    }

    /**
     * Tests functionality of Net_FTP::setDirMatcher()
     *
     * @since 1.4.0a1
     * @return void
     */
    public function testSetDirMatcher()
    {
        $pattern = '/(?:(d)|.)([rwxt-]+)\s+(\w+)\s+(\w+)\s+(\w+)\s(\w+\s+\d+\s+.+)'.
            '\s+(.+)/';
        $map     = array(
            'is_dir' => 1,
            'rights' => 2,
            'user' => 3,
            'group' => 4,
            'size' => 5,
            'date' => 6,
            'name' => 7,
        );

        $res = $this->ftp->setDirMatcher(false, false);
        $this->assertTrue(PEAR::isError($res)
            && $res->getCode() == NET_FTP_ERR_ILLEGALPATTERN,
            'Result of setDirMatcher(boolean, boolean) should give a '.
            'NET_FTP_ERR_ILLEGALPATTERN error');

        $res = $this->ftp->setDirMatcher($pattern, false);
        $this->assertTrue(PEAR::isError($res)
            && $res->getCode() == NET_FTP_ERR_ILLEGALMAP,
            'Result of setDirMatcher(string, boolean) should give a '.
            'NET_FTP_ERR_ILLEGALMAP error');

        $res = $this->ftp->setDirMatcher($pattern, array('a' => 'b'));
        $this->assertTrue(PEAR::isError($res)
            && $res->getCode() == NET_FTP_ERR_ILLEGALMAPVALUE,
            'The items in a matcher map should only contain numeric values');

        $res = $this->ftp->setDirMatcher($pattern, $map);
        $this->assertFalse(PEAR::isError($res),
            'A valid pattern and map should return no error');
    }

    /**
     * Tests changes made to fix bug #9611
     *
     * @since 1.4.0a1
     * @return void
     */
    public function testCheckRemoteDir()
    {
        $res = $this->ftp->_checkRemoteDir('test');
        $this->assertFalse($res, 'test should not be a directory');

        $this->ftp->put('testfile.dat', 'test', FTP_BINARY);
        $res = $this->ftp->_checkRemoteDir('test');
        $this->assertFalse($res, 'test should not be a directory');

        $this->ftp->rm('test');

        $this->ftp->mkdir('test');
        $res = $this->ftp->_checkRemoteDir('test');
        $this->assertTrue($res, 'test should be a directory');
    }

    /**
     * Tests _determineOSMatch
     *
     * @return void
     * @see Net_FTP::_determineOSMatch()
     */
    public function testDetermineOSMatch()
    {
        $dirlist = array(
            'drwxrwsr-x  75 upload.  (?).         3008 Oct 30 21:09 ftp1',
        );

        $res = $this->ftp->_determineOSMatch($dirlist);
        $this->assertFalse(PEAR::isError($res),
            'The directory listing should be recognized');

        $this->assertEquals($res['pattern'],
            $this->ftp->_ls_match['unix']['pattern'],
            'The input should be parsed by the unix pattern');
    }

    /**
     * Return all name keys in the elements of an array, leaving out . and ..
     *
     * @param array $in Multidimensional array
     *
     * @return array Array containing name keys
     */
    function _getNames($in)
    {
        $return = array();
        foreach ($in as $v) {
            if ($v['name'] != '.' && $v['name'] != '..') {
                $return[] = $v['name'];
            }
        }
        return $return;
    }

    /**
     * Return the last element of a local path
     *
     * @param string $in Path
     *
     * @return array Last part of path
     */
    function _getLastPart($in)
    {
        $start = strrpos($in, DIRECTORY_SEPARATOR) + 1;
        return substr($in, $start);
    }
}
