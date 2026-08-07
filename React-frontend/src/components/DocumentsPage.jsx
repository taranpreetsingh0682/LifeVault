import { useState } from 'react';
import './DocumentsPage.css';

/* ─── Static Data ─────────────────────────────────────────────────── */
const CATEGORIES = [
  { id: 'identity',     label: 'Identity',     count: 30, icon: '🪪', cls: 'cat-identity' },
  { id: 'personal',     label: 'Personal',     count: 18, icon: '👤', cls: 'cat-personal' },
  { id: 'education',    label: 'Education',    count: 26, icon: '🎓', cls: 'cat-education' },
  { id: 'certificates', label: 'Certificates', count: 22, icon: '📜', cls: 'cat-certificates' },
  { id: 'images',       label: 'Images',       count: 12, icon: '🖼️', cls: 'cat-images' },
  { id: 'records',      label: 'Records',      count: 10, icon: '📋', cls: 'cat-records' },
];

const DOCUMENTS = [
  { id: 1,  name: 'PAN Card.pdf',             type: 'PDF', category: 'identity',     updated: 'Yesterday, 09:15 PM', size: '240 KB', starred: true  },
  { id: 2,  name: 'Resume.pdf',               type: 'PDF', category: 'personal',     updated: '05 July 2025',        size: '1.2 MB', starred: false },
  { id: 3,  name: 'Aadhaar Card.pdf',         type: 'PDF', category: 'identity',     updated: 'Today, 10:30 AM',     size: '456 KB', starred: true  },
  { id: 4,  name: '10th Marksheet.xls',       type: 'XLS', category: 'education',    updated: '04 July 2025',        size: '512 KB', starred: false },
  { id: 5,  name: 'Passport.pdf',             type: 'PDF', category: 'identity',     updated: '01 June 2025',        size: '600 KB', starred: true  },
  { id: 6,  name: 'Driving Licence.pdf',      type: 'PDF', category: 'identity',     updated: '28 May 2025',         size: '310 KB', starred: false },
  { id: 7,  name: 'B.Tech Degree.pdf',        type: 'PDF', category: 'education',    updated: '20 May 2025',         size: '890 KB', starred: true  },
  { id: 8,  name: 'Vaccination Certificate.pdf', type: 'PDF', category: 'certificates', updated: '12 May 2025',     size: '220 KB', starred: false },
  { id: 9,  name: 'Family Photo.jpg',         type: 'JPG', category: 'images',       updated: '02 May 2025',         size: '3.4 MB', starred: false },
  { id: 10, name: 'Rent Agreement.docx',      type: 'DOC', category: 'records',      updated: '28 Apr 2025',         size: '540 KB', starred: false },
  { id: 11, name: 'Bank Statement.pdf',       type: 'PDF', category: 'personal',     updated: '20 Apr 2025',         size: '1.1 MB', starred: false },
  { id: 12, name: 'Insurance Policy.pdf',     type: 'PDF', category: 'records',      updated: '15 Apr 2025',         size: '760 KB', starred: false },
];

const NAV_LINKS = [
  { id: 'dashboard',  label: 'Dashboard',  icon: '⊞',  badge: null },
  { id: 'documents',  label: 'Documents',  icon: '📄',  badge: 126  },
  { id: 'uploads',    label: 'Uploads',    icon: '⬆',  badge: null },
  { id: 'important',  label: 'Important',  icon: '⭐',  badge: 16   },
  { id: 'profile',    label: 'Profile',    icon: '👤',  badge: null },
  { id: 'settings',   label: 'Settings',   icon: '⚙',  badge: null },
];

const FILTER_TABS = ['All', 'Identity', 'Personal', 'Education', 'Certificates', 'Images', 'Records'];

/* ─── Helpers ─────────────────────────────────────────────────────── */
const typeCls = { PDF: 'type-pdf', DOC: 'type-doc', XLS: 'type-xls', JPG: 'type-jpg' };
const catCls  = {
  identity: 'badge-identity', personal: 'badge-personal',
  education: 'badge-education', certificates: 'badge-certificates',
  images: 'badge-images', records: 'badge-records',
};

/* ─── Sub-components ──────────────────────────────────────────────── */
function Sidebar({ activeNav, onNav }) {
  return (
    <aside className="dp-sidebar">
      <div>
        <div className="dp-brand">
          <span className="dp-brand-icon">🔒</span>
          <span className="dp-brand-name">LifeVault</span>
        </div>

        <nav className="dp-nav">
          {NAV_LINKS.map(link => (
            <button
              key={link.id}
              className={`dp-nav-link${activeNav === link.id ? ' active' : ''}`}
              onClick={() => onNav(link.id)}
            >
              <span className="dp-nav-icon">{link.icon}</span>
              <span className="dp-nav-label">{link.label}</span>
              {link.badge && <span className="dp-nav-badge">{link.badge}</span>}
            </button>
          ))}
        </nav>
      </div>

      <div className="dp-sidebar-footer">
        <div className="dp-storage-widget">
          <div className="dp-storage-row">
            <span className="dp-storage-label">Storage</span>
            <span className="dp-storage-value">1.8 / 5 GB</span>
          </div>
          <div className="dp-storage-track">
            <div className="dp-storage-fill" style={{ width: '36%' }} />
          </div>
          <span className="dp-storage-sub">3.2 GB available</span>
        </div>
        <button className="dp-logout-btn">
          <span>↩</span>
          <span>Logout</span>
        </button>
      </div>
    </aside>
  );
}

function Topbar() {
  return (
    <header className="dp-topbar">
      <div className="dp-search-wrap">
        <span className="dp-search-icon">🔍</span>
        <input className="dp-search-input" placeholder="Search documents..." />
        <button className="dp-search-btn">Search</button>
      </div>

      <div className="dp-topbar-right">
        <button className="dp-icon-btn" title="Notifications">🔔</button>
        <div className="dp-user-pill">
          <div className="dp-avatar">TS</div>
          <div className="dp-user-meta">
            <span className="dp-user-name">Taranpreet Singh</span>
            <span className="dp-user-plan">Premium Plan</span>
          </div>
        </div>
      </div>
    </header>
  );
}

function CategoriesCard({ activeCategory, onCategory }) {
  return (
    <div className="dp-card dp-categories-card">
      <h3 className="dp-card-title">Categories</h3>
      <div className="dp-cat-list">
        {CATEGORIES.map(cat => (
          <button
            key={cat.id}
            className={`dp-cat-row${activeCategory === cat.id ? ' active' : ''}`}
            onClick={() => onCategory(cat.id === activeCategory ? null : cat.id)}
          >
            <span className={`dp-cat-icon ${cat.cls}`}>{cat.icon}</span>
            <div className="dp-cat-meta">
              <span className="dp-cat-name">{cat.label}</span>
              <span className="dp-cat-count">{cat.count} files</span>
            </div>
          </button>
        ))}
      </div>
    </div>
  );
}

function StorageCard() {
  return (
    <div className="dp-card dp-storage-card">
      <div className="dp-storage-header">
        <span className="dp-storage-card-title">Storage</span>
        <a href="#" className="dp-upgrade-link">Upgrade</a>
      </div>
      <p className="dp-storage-meta">
        <strong>1.8 GB</strong> of 5 GB Used
      </p>
      <div className="dp-storage-bar-wrap">
        <div className="dp-storage-bar-fill" style={{ width: '36%' }} />
      </div>
      <div className="dp-storage-footer">
        <span>3.2 GB Available</span>
        <strong>36%</strong>
      </div>
    </div>
  );
}

function FilterToolbar({ activeFilter, onFilter, sort, onSort, view, onView }) {
  return (
    <div className="dp-filter-toolbar">
      <div className="dp-filter-pills">
        {FILTER_TABS.map(tab => (
          <button
            key={tab}
            className={`dp-pill${activeFilter === tab ? ' active' : ''}`}
            onClick={() => onFilter(tab)}
          >
            {tab}
          </button>
        ))}
      </div>

      <div className="dp-controls">
        <div className="dp-sort-wrap">
          <select
            className="dp-sort-select"
            value={sort}
            onChange={e => onSort(e.target.value)}
          >
            <option value="newest">Newest first</option>
            <option value="oldest">Oldest first</option>
            <option value="name">Name A–Z</option>
            <option value="size">Largest first</option>
          </select>
          <span className="dp-sort-arrow">▾</span>
        </div>

        <div className="dp-view-switcher">
          <button
            className={`dp-view-btn${view === 'list' ? ' active' : ''}`}
            onClick={() => onView('list')}
            title="List view"
          >☰</button>
          <button
            className={`dp-view-btn${view === 'grid' ? ' active' : ''}`}
            onClick={() => onView('grid')}
            title="Grid view"
          >⊞</button>
        </div>
      </div>
    </div>
  );
}

function DocumentRow({ doc, onStar }) {
  return (
    <tr className="dp-doc-row">
      <td>
        <div className="dp-doc-name-cell">
          <span className={`dp-type-badge ${typeCls[doc.type]}`}>{doc.type}</span>
          <span className="dp-doc-name">{doc.name}</span>
        </div>
      </td>
      <td>
        <span className={`dp-cat-badge ${catCls[doc.category]}`}>
          {doc.category.charAt(0).toUpperCase() + doc.category.slice(1)}
        </span>
      </td>
      <td className="dp-td-muted">{doc.updated}</td>
      <td className="dp-td-muted">{doc.size}</td>
      <td>
        <button
          className={`dp-star-btn${doc.starred ? ' starred' : ''}`}
          onClick={() => onStar(doc.id)}
          title={doc.starred ? 'Unstar' : 'Star'}
        >
          {doc.starred ? '★' : '☆'}
        </button>
      </td>
      <td>
        <button className="dp-dots-btn" title="More options">⋮</button>
      </td>
    </tr>
  );
}

function DocumentGrid({ doc, onStar }) {
  return (
    <div className="dp-grid-card">
      <div className="dp-grid-card-top">
        <span className={`dp-type-badge ${typeCls[doc.type]}`}>{doc.type}</span>
        <button
          className={`dp-star-btn${doc.starred ? ' starred' : ''}`}
          onClick={() => onStar(doc.id)}
        >
          {doc.starred ? '★' : '☆'}
        </button>
      </div>
      <div className="dp-grid-icon">
        {doc.type === 'JPG' ? '🖼️' : doc.type === 'XLS' ? '📊' : doc.type === 'DOC' ? '📝' : '📄'}
      </div>
      <p className="dp-grid-name">{doc.name}</p>
      <div className="dp-grid-meta">
        <span className={`dp-cat-badge ${catCls[doc.category]}`}>
          {doc.category.charAt(0).toUpperCase() + doc.category.slice(1)}
        </span>
        <span className="dp-grid-size">{doc.size}</span>
      </div>
      <p className="dp-grid-date">{doc.updated}</p>
    </div>
  );
}

/* ─── Main Component ──────────────────────────────────────────────── */
export default function DocumentsPage() {
  const [activeNav,      setActiveNav]      = useState('documents');
  const [activeFilter,   setActiveFilter]   = useState('All');
  const [activeCategory, setActiveCategory] = useState(null);
  const [sort,           setSort]           = useState('newest');
  const [view,           setView]           = useState('list');
  const [page,           setPage]           = useState(1);
  const [docs,           setDocs]           = useState(DOCUMENTS);

  const PER_PAGE = 12;

  /* Filter by pill OR sidebar category */
  const filtered = docs.filter(d => {
    const matchesPill = activeFilter === 'All' || d.category === activeFilter.toLowerCase();
    const matchesCat  = !activeCategory || d.category === activeCategory;
    return matchesPill && matchesCat;
  });

  /* Sort */
  const sorted = [...filtered].sort((a, b) => {
    if (sort === 'name')   return a.name.localeCompare(b.name);
    if (sort === 'oldest') return a.id - b.id;
    if (sort === 'newest') return b.id - a.id;
    return 0;
  });

  const totalPages = Math.max(1, Math.ceil(sorted.length / PER_PAGE));
  const paginated  = sorted.slice((page - 1) * PER_PAGE, page * PER_PAGE);

  const toggleStar = id => {
    setDocs(prev => prev.map(d => d.id === id ? { ...d, starred: !d.starred } : d));
  };

  return (
    <div className="dp-layout">
      <Sidebar activeNav={activeNav} onNav={setActiveNav} />

      <div className="dp-main-wrapper">
        <Topbar />

        <div className="dp-content">
          {/* Page Header */}
          <div className="dp-page-header">
            <div>
              <h1 className="dp-page-title">Documents</h1>
              <p className="dp-page-sub">All your files, organized, searchable and secure.</p>
            </div>
            <button className="dp-upload-btn">
              <span>⬆</span> Upload file
            </button>
          </div>

          {/* Body Grid */}
          <div className="dp-body-grid">
            {/* Left Panel */}
            <aside className="dp-left-panel">
              <CategoriesCard activeCategory={activeCategory} onCategory={setActiveCategory} />
              <StorageCard />
            </aside>

            {/* Right Panel */}
            <div className="dp-right-panel">
              <FilterToolbar
                activeFilter={activeFilter}
                onFilter={f => { setActiveFilter(f); setActiveCategory(null); setPage(1); }}
                sort={sort}
                onSort={setSort}
                view={view}
                onView={setView}
              />

              {/* Documents Card */}
              <div className="dp-docs-card">
                {view === 'list' ? (
                  <table className="dp-table">
                    <thead>
                      <tr>
                        <th>DOCUMENT NAME</th>
                        <th>CATEGORY</th>
                        <th>UPDATED ON</th>
                        <th>SIZE</th>
                        <th>STARRED</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      {paginated.length === 0 ? (
                        <tr>
                          <td colSpan={6} className="dp-empty">No documents found.</td>
                        </tr>
                      ) : paginated.map(doc => (
                        <DocumentRow key={doc.id} doc={doc} onStar={toggleStar} />
                      ))}
                    </tbody>
                  </table>
                ) : (
                  <div className="dp-grid-view">
                    {paginated.length === 0 ? (
                      <p className="dp-empty">No documents found.</p>
                    ) : paginated.map(doc => (
                      <DocumentGrid key={doc.id} doc={doc} onStar={toggleStar} />
                    ))}
                  </div>
                )}

                {/* Footer */}
                <div className="dp-table-footer">
                  <span className="dp-showing">
                    Showing {Math.min((page - 1) * PER_PAGE + 1, sorted.length)}–
                    {Math.min(page * PER_PAGE, sorted.length)} of {sorted.length} documents
                  </span>

                  <div className="dp-pagination">
                    <button
                      className="dp-page-btn"
                      disabled={page === 1}
                      onClick={() => setPage(p => p - 1)}
                    >Prev</button>

                    {Array.from({ length: totalPages }, (_, i) => i + 1).map(n => (
                      <button
                        key={n}
                        className={`dp-page-btn dp-page-num${n === page ? ' active' : ''}`}
                        onClick={() => setPage(n)}
                      >{n}</button>
                    ))}

                    <button
                      className="dp-page-btn"
                      disabled={page === totalPages}
                      onClick={() => setPage(p => p + 1)}
                    >Next</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
