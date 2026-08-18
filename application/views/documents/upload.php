<!-- Main Upload View Container -->
<main class="documents-container upload-page-container">

  <!-- Page Header -->
  <div class="documents-header">
    <div class="doc-title-area">
      <h1 class="doc-title">Upload Documents</h1>
      <p class="doc-subtitle">Add new files to your vault — drag and drop or browse.</p>
    </div>
  </div>

  <!-- Primary Drag & Drop Zone Card -->
  <div class="upload-dropzone-card mb-4">
    <div class="dropzone-area" id="dropzoneArea">
      <input type="file" id="fileDropInput" data-upload-url="<?= site_url('upload/store'); ?>" hidden accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx">
      
      <div class="cloud-icon-circle">
        <i class="bi bi-cloud-arrow-up"></i>
      </div>
      
      <h3 class="dropzone-heading">Drag & drop files here</h3>
      <p class="dropzone-subtext">or click below to browse from your device</p>
      
      <button class="btn btn-browse-files" type="button" id="browseFilesBtn">
        Browse Files
      </button>
      
      <span class="dropzone-supported-text">
        Supported: PDF, JPG, PNG, DOCX, XLSX — Max file size 25 MB
      </span>
    </div>
  </div>

  <!-- Middle Grid: Upload Queue & Upload Tips -->
  <div class="row g-4 mb-4">
    
    <!-- Upload Queue Card -->
    <div class="col-12 col-lg-7">
      <div class="upload-card shadow-sm h-100">
        <div class="upload-card-header d-flex align-items-center justify-content-between">
          <h5 class="card-section-title mb-0">Upload Queue</h5>
          <span class="queue-count-badge" id="queueCountBadge">Ready</span>
        </div>
        
        <div class="upload-queue-list mt-3 d-flex flex-column gap-3" id="uploadQueueList">
          
          <!-- Queue Item 1 -->
          <div class="queue-item">
            <div class="d-flex align-items-center justify-content-between mb-1">
              <div class="file-name-wrap d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-pdf">PDF</span>
                <span class="file-title-text">Electricity_Bill.pdf</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <span class="progress-percent">80%</span>
                <span class="status-pill status-uploading">Uploading</span>
              </div>
            </div>
            <div class="progress queue-progress-bar">
              <div class="progress-bar bg-blue-progress" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>

          <!-- Queue Item 2 -->
          <div class="queue-item">
            <div class="d-flex align-items-center justify-content-between mb-1">
              <div class="file-name-wrap d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-pdf">PDF</span>
                <span class="file-title-text">Insurance_Policy.pdf</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <span class="progress-percent">45%</span>
                <span class="status-pill status-uploading">Uploading</span>
              </div>
            </div>
            <div class="progress queue-progress-bar">
              <div class="progress-bar bg-blue-progress" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>

          <!-- Queue Item 3 -->
          <div class="queue-item">
            <div class="d-flex align-items-center justify-content-between mb-1">
              <div class="file-name-wrap d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-jpg">JPG</span>
                <span class="file-title-text">Voter_ID.jpg</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <span class="progress-percent">100%</span>
                <span class="status-pill status-done">Done</span>
              </div>
            </div>
            <div class="progress queue-progress-bar">
              <div class="progress-bar bg-emerald-progress" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>

          <!-- Queue Item 4 -->
          <div class="queue-item">
            <div class="d-flex align-items-center justify-content-between mb-1">
              <div class="file-name-wrap d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-pdf">PDF</span>
                <span class="file-title-text">Bank_Statement.pdf</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <span class="progress-percent">Waiting</span>
                <span class="status-pill status-queued">Queued</span>
              </div>
            </div>
            <div class="progress queue-progress-bar">
              <div class="progress-bar bg-queued-progress" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Upload Tips Card -->
    <div class="col-12 col-lg-5">
      <div class="upload-card shadow-sm h-100">
        <h5 class="card-section-title mb-3">Upload Tips</h5>
        
        <div class="tips-list d-flex flex-column gap-3">
          
          <div class="tip-item d-flex align-items-center gap-3">
            <div class="tip-icon-badge icon-shield-purple">
              <i class="bi bi-shield-check"></i>
            </div>
            <span class="tip-text">Files are encrypted automatically the moment upload completes.</span>
          </div>

          <div class="tip-item d-flex align-items-center gap-3">
            <div class="tip-icon-badge icon-tag-amber">
              <i class="bi bi-tags"></i>
            </div>
            <span class="tip-text">Documents are auto-sorted into categories using file names and type.</span>
          </div>

          <div class="tip-item d-flex align-items-center gap-3">
            <div class="tip-icon-badge icon-star-emerald">
              <i class="bi bi-star"></i>
            </div>
            <span class="tip-text">You can star any file after upload to pin it to Important.</span>
          </div>

          <div class="tip-item d-flex align-items-center gap-3">
            <div class="tip-icon-badge icon-alert-pink">
              <i class="bi bi-exclamation-circle"></i>
            </div>
            <span class="tip-text">Max file size is 25 MB — larger files should be compressed first.</span>
          </div>

        </div>
      </div>
    </div>

  </div>

  <!-- Bottom Section: Recent Uploads -->
  <div class="upload-card shadow-sm">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h5 class="card-section-title mb-0">Recent Uploads</h5>
      <a href="<?= site_url('Documents/documents'); ?>" class="view-all-link">View all &rarr;</a>
    </div>

    <div class="table-responsive">
      <table class="table vault-table align-middle">
        <thead>
          <tr>
            <th scope="col">DOCUMENT NAME</th>
            <th scope="col">CATEGORY</th>
            <th scope="col">UPLOADED</th>
            <th scope="col">SIZE</th>
            <th scope="col">STARRED</th>
            <th scope="col" class="text-end">ACTIONS</th>
          </tr>
        </thead>
        <tbody id="recentUploadsBody">
          <tr>
            <td>
              <div class="d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-jpg">JPG</span>
                <span class="doc-table-name">Voter_ID.jpg</span>
              </div>
            </td>
            <td><span class="table-cat-badge badge-identity">Identity</span></td>
            <td class="text-muted-sub">Just now</td>
            <td><strong>2.1 MB</strong></td>
            <td>
              <button class="star-btn" type="button" title="Star document">
                <i class="bi bi-star"></i>
              </button>
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button class="action-dots-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-eye"></i> View File</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-download"></i> Download</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-content-item text-danger" href="#"><i class="bi bi-trash"></i> Delete</a></li>
                </ul>
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-pdf">PDF</span>
                <span class="doc-table-name">Aadhaar Card.pdf</span>
              </div>
            </td>
            <td><span class="table-cat-badge badge-identity">Identity</span></td>
            <td class="text-muted-sub">Today, 10:30 AM</td>
            <td><strong>456 KB</strong></td>
            <td>
              <button class="star-btn starred" type="button" title="Unstar document">
                <i class="bi bi-star-fill"></i>
              </button>
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button class="action-dots-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-eye"></i> View File</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-download"></i> Download</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-content-item text-danger" href="#"><i class="bi bi-trash"></i> Delete</a></li>
                </ul>
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <div class="d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-xls">XLS</span>
                <span class="doc-table-name">10th Marksheet.xls</span>
              </div>
            </td>
            <td><span class="table-cat-badge badge-education">Education</span></td>
            <td class="text-muted-sub">04 July 2025</td>
            <td><strong>512 KB</strong></td>
            <td>
              <button class="star-btn" type="button" title="Star document">
                <i class="bi bi-star"></i>
              </button>
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button class="action-dots-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-eye"></i> View File</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-download"></i> Download</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-content-item text-danger" href="#"><i class="bi bi-trash"></i> Delete</a></li>
                </ul>
              </div>
            </td>
          </tr>

        </tbody>
      </table>
    </div>

  </div>

</main>

<?php
function lv_upload_type_label($type) {
  $ext = strtoupper(ltrim((string) $type, '.'));
  if (in_array($ext, array('JPG', 'JPEG', 'PNG'), TRUE)) return 'JPG';
  if (in_array($ext, array('DOC', 'DOCX'), TRUE)) return 'DOC';
  if (in_array($ext, array('XLS', 'XLSX'), TRUE)) return 'XLS';
  return $ext ?: 'FILE';
}

function lv_upload_size_label($bytes) {
  $bytes = (float) $bytes;
  return $bytes >= 1048576 ? round($bytes / 1048576, 2) . ' MB' : max(1, round($bytes / 1024)) . ' KB';
}

$lv_recent_uploads = array_map(function ($document) {
  return array(
    'id' => (int) $document->id,
    'title' => $document->title,
    'type' => lv_upload_type_label($document->file_type),
    'category' => strtolower($document->category),
    'categoryLabel' => ucfirst($document->category),
    'uploaded' => date('d M Y, h:i A', strtotime($document->uploaded_at)),
    'size' => lv_upload_size_label($document->file_size),
    'important' => (bool) $document->is_important
  );
}, isset($recent_documents) ? $recent_documents : array());
?>

<script>
(function () {
  'use strict';

  const docs = <?= json_encode($lv_recent_uploads); ?>;
  const uploadUrl = '<?= site_url('upload/store'); ?>';
  const viewUrl = '<?= site_url('documents/view/'); ?>';
  const downloadUrl = '<?= site_url('documents/download/'); ?>';
  const deleteUrl = '<?= site_url('documents/delete/'); ?>';
  const starUrl = '<?= site_url('documents/toggleImportant/'); ?>';

  const queueList = document.getElementById('uploadQueueList');
  const queueBadge = document.getElementById('queueCountBadge');
  const recentBody = document.getElementById('recentUploadsBody');
  const fileInput = document.getElementById('fileDropInput');
  const dropzone = document.getElementById('dropzoneArea');

  const typeClass = { PDF: 'badge-type-pdf', DOC: 'badge-type-doc', XLS: 'badge-type-xls', JPG: 'badge-type-jpg' };
  const catClass = {
    identity: 'badge-identity',
    personal: 'badge-personal',
    education: 'badge-education',
    certificates: 'badge-certificates',
    images: 'badge-images',
    records: 'badge-records'
  };

  function esc(value) {
    return String(value || '').replace(/[&<>"']/g, function (char) {
      return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[char];
    });
  }

  function guessCategory(fileName) {
    const ext = (fileName.split('.').pop() || '').toLowerCase();
    if (['jpg', 'jpeg', 'png'].includes(ext)) return 'images';
    return 'records';
  }

  function fileType(fileName) {
    const ext = (fileName.split('.').pop() || '').toUpperCase();
    if (['JPG', 'JPEG', 'PNG'].includes(ext)) return 'JPG';
    if (['DOC', 'DOCX'].includes(ext)) return 'DOC';
    if (['XLS', 'XLSX'].includes(ext)) return 'XLS';
    return 'PDF';
  }

  function renderRecentUploads() {
    if (!recentBody) return;
    if (!docs.length) {
      recentBody.innerHTML = '<tr><td colspan="6" class="empty-state-cell text-center py-4"><i class="bi bi-folder2-open" style="font-size:2rem;color:#cbd5e1;display:block;margin-bottom:.5rem;"></i>No documents uploaded yet.</td></tr>';
      return;
    }

    recentBody.innerHTML = docs.map(function (doc) {
      return `<tr>
        <td><div class="d-flex align-items-center gap-2"><span class="badge-file-type ${typeClass[doc.type] || 'badge-type-pdf'}">${esc(doc.type)}</span><span class="doc-table-name">${esc(doc.title)}</span></div></td>
        <td><span class="table-cat-badge ${catClass[doc.category] || 'badge-records'}">${esc(doc.categoryLabel)}</span></td>
        <td class="text-muted-sub">${esc(doc.uploaded)}</td>
        <td><strong>${esc(doc.size)}</strong></td>
        <td><a class="star-btn${doc.important ? ' starred' : ''}" href="${starUrl}${doc.id}" title="${doc.important ? 'Unstar document' : 'Star document'}"><i class="bi bi-star${doc.important ? '-fill text-warning' : ''}"></i></a></td>
        <td class="text-end">
          <div class="dropdown">
            <button class="action-dots-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
              <li><a class="dropdown-content-item" target="_blank" href="${viewUrl}${doc.id}"><i class="bi bi-eye"></i> View File</a></li>
              <li><a class="dropdown-content-item" href="${downloadUrl}${doc.id}"><i class="bi bi-download"></i> Download</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-content-item text-danger" onclick="return confirm('Delete this document permanently?');" href="${deleteUrl}${doc.id}"><i class="bi bi-trash"></i> Delete</a></li>
            </ul>
          </div>
        </td>
      </tr>`;
    }).join('');
  }

  function renderEmptyQueue() {
    if (!queueList) return;
    queueList.innerHTML = '<div class="empty-state-cell text-center py-4"><i class="bi bi-cloud-arrow-up" style="font-size:2rem;color:#cbd5e1;display:block;margin-bottom:.5rem;"></i>Choose a file to upload it into your vault.</div>';
  }

  function renderQueue(file) {
    if (!queueList || !queueBadge) return;
    const type = fileType(file.name);
    queueBadge.textContent = '1 file';
    queueList.innerHTML = `<div class="queue-item">
      <div class="d-flex align-items-center justify-content-between mb-1">
        <div class="file-name-wrap d-flex align-items-center gap-2">
          <span class="badge-file-type ${typeClass[type] || 'badge-type-pdf'}">${type}</span>
          <span class="file-title-text">${esc(file.name)}</span>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span class="progress-percent">Saving</span>
          <span class="status-pill status-uploading">Uploading</span>
        </div>
      </div>
      <div class="progress queue-progress-bar"><div class="progress-bar bg-blue-progress" role="progressbar" style="width:100%"></div></div>
    </div>`;
  }

  function uploadFile(file) {
    if (!file) return;
    renderQueue(file);
    const formData = new FormData();
    formData.append('document', file);
    formData.append('title', file.name.replace(/\.[^.]+$/, ''));
    formData.append('category', guessCategory(file.name));
    fetch(uploadUrl, { method: 'POST', body: formData, credentials: 'same-origin' })
      .then(function (response) {
        if (!response.ok) throw new Error('Upload failed');
        window.location.href = '<?= site_url('upload'); ?>';
      })
      .catch(function () {
        if (!queueList) return;
        queueList.querySelector('.progress-percent').textContent = 'Failed';
        queueList.querySelector('.status-pill').textContent = 'Failed';
        queueList.querySelector('.status-pill').className = 'status-pill status-queued';
      });
  }

  renderRecentUploads();
  renderEmptyQueue();

  if (fileInput) {
    fileInput.addEventListener('change', function (event) {
      event.stopImmediatePropagation();
      uploadFile(fileInput.files && fileInput.files[0]);
    }, true);
  }

  if (dropzone) {
    dropzone.addEventListener('drop', function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      dropzone.classList.remove('dragover');
      uploadFile(event.dataTransfer.files && event.dataTransfer.files[0]);
    }, true);
  }
})();
</script>
