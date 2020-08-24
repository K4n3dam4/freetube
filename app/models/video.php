<?php 
//  ======== VIDEO CLASS ========

class Video {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }


  // =======GET VIDEOS

  // get all videos
  public function getVideos() {
    // join databases and get all videoa
    $this->db->query(
    'SELECT * 
    FROM videos 
    INNER JOIN channels 
    ON videos.vid_channel_id = channels.channel_id 
    INNER JOIN categories 
    ON videos.vid_cat_id = categories.cat_id 
    ORDER BY channel_name');

    return $this->db->resultSet();
  }

  // get all videos ajax
  public function getVideosAjax($start, $limit) {
    // join databases and get all videos
    $this->db->query(
    "SELECT *
    FROM videos 
    INNER JOIN channels 
    ON videos.vid_channel_id = channels.channel_id 
    INNER JOIN categories 
    ON videos.vid_cat_id = categories.cat_id 
    ORDER BY vid_like_count DESC 
    LIMIT $start,$limit");

    $result = $this->db->resultSet();

    if ($this->db->rowCount() > 0) {
      return $result;
    } else {
      return false;
    }
  }

  // get video 
  public function getVideo($video) {
    // join databases and get video
    $this->db->query(
    'SELECT *
    FROM videos
    INNER JOIN channels
    ON videos.vid_channel_id = channels.channel_id
    INNER JOIN categories
    ON videos.vid_cat_id = categories.cat_id
    WHERE vid_id = (?)');

    $this->db->bind(1, $video);

    return $this->db->single();
  }

  // get channel videos
  public function getChannelVideos($channel) {
    // join databases and get videos of channel
    $this->db->query(
    'SELECT * 
    FROM videos 
    INNER JOIN channels 
    ON videos.vid_channel_id = channels.channel_id 
    INNER JOIN categories 
    ON videos.vid_cat_id = categories.cat_id 
    WHERE channel_id = (?)');

    $this->db->bind(1, $channel);

    return $this->db->resultSet();
  }

  // ========ADD VIDEOS
  public function addVideo($data) {
    $this->db->query(
    'INSERT INTO videos 
    (vid_cat_id, vid_channel_id, vid_tags, vid_title, vid_url, vid_date) 
    VALUES (?, ?, ?, ?, ?, ?)');

    $this->db->bind(1, $data['vid_cat_id']);
    $this->db->bind(2, $data['vid_channel_id']);
    $this->db->bind(3, $data['vid_tags']);
    $this->db->bind(4, $data['vid_title']);
    $this->db->bind(5, $data['vid_upload']);
    $this->db->bind(6, $data['vid_date']);

    $this->db->execute();
  }

  // =======SEARCH VIDEOS

  public function searchVideosAjax($limit, $start, $search) {
    // similar to keyword
    $s = '%'. $search . '%';

    // Search channel names for keywords
    $this->db->query(
    "SELECT * 
    FROM videos 
    INNER JOIN channels 
    ON videos.vid_channel_id = channels.channel_id 
    INNER JOIN categories 
    ON videos.vid_cat_id = categories.cat_id 
    WHERE channel_name LIKE (?) 
    OR vid_tags LIKE (?) OR vid_title LIKE (?) 
    ORDER BY vid_like_count DESC 
    LIMIT $start,$limit");

    $this->db->bind(1, $s);
    $this->db->bind(2, $s);
    $this->db->bind(3, $s);

    $result = $this->db->resultSet();

    // return result
    if ($this->db->rowCount() > 0) {
      return $result;
    } else {
      return false;
    }
  }

  // search channel videos for keyword
  public function searchChannelVideos($channel, $search) {
    // similar to keyword
    $s = '%'. $search .'%';

    $this->db->query(
    'SELECT * 
    FROM videos 
    INNER JOIN channels 
    ON videos.vid_channel_id = channels.channel_id 
    INNER JOIN categories 
    ON videos.vid_cat_id = categories.cat_id 
    WHERE channel_id = (?) 
    AND (vid_tags LIKE (?) OR vid_title LIKE (?))');

    $this->db->bind(1, $channel);
    $this->db->bind(2, $s);
    $this->db->bind(3, $s);

    // return result
    return $this->db->resultset();
  }

  // =========DELETE VIDEOS

  // return video to delete
  public function videoToDelete($video) {
    $this->db->query(
    'SELECT *
    FROM videos
    WHERE vid_id = (?)');

    $this->db->bind(1, $video);

    return $this->db->single();
  }

  // delete channel video
  public function deleteChannelVideo($video) {
    $this->db->query(
    'DELETE
    FROM videos
    WHERE vid_id = (?)');

    $this->db->bind(1, $video);

    $this->db->execute();
  }

  // ===========UPDATE VIDEOS

  // update likes
  public function updateLikes($vid_id, string $operation) {
    if ($operation === 'add') {
      $this->db->query(
      'UPDATE videos
      SET vid_like_count = vid_like_count + 1
      WHERE vid_id = (?)');
    } else if ($operation === 'sub') {
      $this->db->query(
      'UPDATE videos
      SET vid_like_count = vid_like_count - 1
      WHERE vid_id = (?)');
    }

    $this->db->bind(1, $vid_id);

    $this->db->execute();
  }

  // update comments
  public function updateComments($vid_id, string $operation) {
    if ($operation === 'add') {
      $this->db->query(
      'UPDATE videos
      SET vid_com_count = vid_com_count + 1
      WHERE vid_id = (?)');
    } else if ($operation === 'sub') {
      $this->db->query(
      'UPDATE videos
      SET vid_com_count = vid_com_count - 1
      WHERE vid_id = (?)');
    }

    $this->db->bind(1, $vid_id);

    $this->db->execute();
  }

  // edit
  public function editChannelVideo($video) {
    $this->db->query(
    'UPDATE videos
    SET vid_cat_id = (?), vid_title = (?), vid_tags = (?) 
    WHERE vid_id = (?)');

    $this->db->bind(1, $video['edit_cat_id']);
    $this->db->bind(2, $video['edit_title']);
    $this->db->bind(3, $video['edit_tags']);
    $this->db->bind(4, $video['vid_id']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }

  }

  public function editAdminVideo($video)
  {
    $this->db->query(
    'UPDATE videos
    SET vid_title = (?), vid_cat_id = (?), vid_tags = (?), vid_com_count = (?), vid_like_count = (?)
    WHERE vid_id = (?)');

    $this->db->bind(1, $video['vid_title']);
    $this->db->bind(2, $video['vid_cat_id']);
    $this->db->bind(3, $video['vid_tags']);
    $this->db->bind(4, $video['vid_com_count']);
    $this->db->bind(5, $video['vid_like_count']);
    $this->db->bind(6, $video['vid_id']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }

  }

  public function updateVideoURL($video) {
    $this->db->query(
    'UPDATE videos
    SET vid_url = (?)
    WHERE vid_id = (?)');

    $this->db->bind(1, $video['video']);
    $this->db->bind(2, $video['vid_id']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // ========COUNT

  public function countVideos()
  {
    $this->db->query(
    'SELECT * 
    FROM videos');

    $this->db->resultSet();

    return $this->db->rowCount();
  }
}


?>