<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" dir="ltr">
<head>

<title>Participatory Culture Foundation - Make a Video Channel</title>
<style type="text/css">@import "channel.css";</style>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">
_uacct = "UA-163840-1";
urchinTracker();
</script>
</head>
<body>

<div id="rap">


<h2>Video Hosting Options</h2>

<p>There are several good options available for hosting videos, each has costs and benefits.</p>

<h3>Hosting Directly on Your Server</h3>
<p>The traditional way to offer videos on a website is to host them directly on the hard drive of the web server.  Direct hosting tends to be fast and is as reliable as the hosting for your website as a whole.  The downside is that the entire storage and bandwidth burden falls on your server.  Other options can relieve some or all of that cost, which means you can offer big, high quality videos without worrying about bandwidth.  If you do decide to host videos directly on your site, Broadcast Machine lets you enter the URL of the video location, add the information and thumbnail, and publish to your channel.</p>

<h3>Torrent Seeding</h3>
<p>Torrent technology lets you offer files in your channel with no bandwidth or storage costs.  This means that you can send more videos at higher quality to more people.  When you post a new file with Broadcast Machine, it will create a 'torrent' and begin sharing the file from the computer where the file was posted.  When users download pieces of the video file, they also automatically upload pieces that they already have.  As more people download, there is more sharing happening, which means that downloads for everyone tend to get faster.  Your server keeps track of who is downloading and uploading the file and connects them to each other.</p>

<p>The downside of hosting with torrents is that there are some additional logistics that need to be managed.  First, for the file to be available, there needs to be someone on the network who has a full copy.  This begins with the person who posts the file.  For the file to remain available, the person who posts the file must continuously make it available, using the Broadcast Machine Helper application.  The computer that's sharing the file must remain connected to the internet and turned on.  Once there are other people on the network who are sharing the file, the original poster can disconnect (you can see how many other 'seeders' -- people with full copies of the file that are connected -- in the 'Files' tab in Broadcast Machine).  However, if all other seeders disconnect the file will become unavailable again and the original poster will need to reconnect to make it available.  Server-sharing (see below) can solve this problem.</p>

<p>A second consideration is that with large files, it takes some time before enough people have a copy of the file, and in the meantime downloads can be slow.  This startup time depends entirely on the speed of the connection of the computer that is seeding the file.  Residential broadband connections have relatively slow sharing speeds, while business or univerisity connections have very fast sharing speeds.  If rapid availability of videos is important (a daily news show, for example), then the startup time for the torrent should be tested. </p>

<p>A third consideration is firewalls.  A firewall is a software barrier between a person's computer and the internet that protects them from viruses and hackers.  Most home users are behind a firewall.  The problem with firewalls and torrents is that it makes it difficult for two users that are behind a firewall to connect to each other.  This means that if you post a torrent to Broadcast Machine and then ask a friend to try downloading it, the download may not work, even though everything is setup correctly.  In practice, however, if a file is being downloaded by more than a few users, firewalls tend not to pose a problem. This is because if anyone who is downloading a torrent is not behind a firewall, then they can help facilitate downloads for everyone else.  Additionally, new torrent downloading programs are beginning to add features that can work around firewalls.  As more of your users gain this functionality, there will be less and less of a firewall problem, even for people who are using older software (users that can work around firewalls will be able to get through to those that can't).  We will be working on adding firewall evasion to our video player in the next few months.</p>

<p>A fourth consideration is that some colleges and universities block torrent traffic.  We hope that the compelling public interest nature of many of these video channels will encourage schools to rethink their policies, but for the time-being torrent files will not be available to people at these schools.</p>

<p>While these are serious challenges, they should not feel too overwhelming-- all of them are very manageable and torrent hosting is used by thousands of people every day to share enormous amounts video over the internet. </p>

<h3>Torrents with Server-Sharing</h3>
<p>Server-sharing is something of a compromise between hosting files directly and using a completely decentralized torrent setup-- it lets you use your server as one of the torrent seeders.  This means that there is always at least one seeder available for a file.  Unlike seeding a torrent from a personal computer, server-sharing does require server disk space and bandwidth.  However, the bandwidth used will be dramatically lower than what would be required if you directly hosted the file.  </p>

<p>On Linux, Mac OSX, and UNIX servers, Broadcast Machine will have server-sharing enabled by default.  When you post a file you can choose to turn on server-sharing.  When you do, the server will begin downloading the file from the computer that is posting it.  When the download is complete (you can see that status in the 'files' tab) you will be able to stop sharing the file from the personal computer.  Since webservers have very fast internet connections, using server-sharing will also speed up downloads for users, even before the server has a full copy of the file.  After some time, you may see that there are enough other seeders of the file on the network, that you can pause server-sharing for an individual file to save bandwidth.  If the other seeders disappear, server-sharing can be restarted.  We will eventually be adding functionality in Broadcast Machine that will more actively manage this process.</p>

<h3>Free Hosting Sites</h3>
<p>There are several sites on the web that will permanently host certain kinds of files for free.  If it works for you, this can be the best option for hosting as it requires none of your bandwidth and no torrent setup work.</p>

<p><em>Ourmedia</em><br />
<a href="http://www.ourmedia.org">Ourmedia</a> is a site devoted to hosting media for everyone who wants hosting.  The site is community-oriented and relies on archive.org serves to store the data.  Files that are posted to Ourmedia are available within "minutes to hours", depending on the backlog, but that time delay should be getting shorter over the next few months.  <a href="http://ourmedia.org/mission/faq/contributors-faq">Read more</a> about using Ourmedia for hosting your videos.</p>

<p><em>Archive.org</em><br />
The Internet Archive (<a href="http://www.archive.org/">archive.org</a>) is the largest site for hosting media files.  Archive.org will host any media file and will make it permanently available on their site.  To use their hosting, simply <a href="http://www.archive.org/contribute.php">sign-up</a> and follow their instructions for uploading files.  There can be a delay of minutes or hours between the time that you post a video and the time when it becomes available for download.</p>

<p><a href="index.php"><< Back to the Guide</a></p>
</div>

</body>
</html>
