# 🌟 EL-Malak-Careers (منصة ملاك كاريرز للتوظيف)

منصة توظيف متكاملة واحترافية مبنية باستعمال **Laravel 12** ومصممة بأعلى معايير الأمان والتصميم الفخم (UX/UI) لإدارة طلبات التوظيف والشركات والترشيح الذكي.

---

## ✨ المميزات الرئيسية (Key Features)

- 👥 **إدارة الباحثين عن عمل والشركات (Job Seekers & Companies):** أدوار صلاحيات متكاملة باستعمال Spatie Permissions.
- 📄 **مولد السيرة الذاتية الاحترافي (Auto CV Builder):** توليد سيرة ذاتية PDF فخمة ومصممة باحترافية من واقع بيانات الحساب بنقرة واحدة.
- ⭐ **نظام التقييم والملاحظات السرية للإدمين (Candidate Rating & Private Notes):** تقييم المتقدمين بالنجوم (1 إلى 5 ⭐) وكتابة ملاحظات سرية للمقابلات.
- 🏢 **لوحة متابعة المتقدمين للشركات (Applicant Kanban Board):** لوحة تفاعلية بمراحل التوظيف (جديد ➔ قيد التقييم ➔ مقابلة شخصية ➔ مقبولة / مرفوضة).
- 🎯 **نظام الترشيح الذكي للوظائف (Smart Job Matching):** مطابقة الخبرات والمهارات تلقائياً مع متطلبات الوظائف وحساب Match Score.
- 📦 **تنزيل جميع السير الذاتية في ملف ZIP (Bulk CV Download):** تجميع وتنزيل كافة سير المتقدمين المفلترين داخل ملف ZIP مضغوط.
- 📊 **تصدير شيت Excel مخصص (CSV Export):** تصدير كامل بيانات الباحثين بترميز UTF-8 دعم كامل للغة العربية.
- 🛡️ **أمان وحماية OWASP المتقدمة:**
  - تخزين الملفات الحساسة (CVs والخطابات) في مجلدات خاصة غير قابلة للوصول المباشر (`storage/app/private/`).
  - رؤوس أمان عالية (`CSP`, `HSTS`, `X-Frame-Options`, `Permissions-Policy`).
  - تقييد عدد المحاولات (Rate Limiting) على جميع مسارات الدخول والتسجيل وإعادة ضبط كلمة المرور.

---

## 🛠️ التقنيات المستخدمة (Tech Stack)

- **Framework:** Laravel 12.x
- **Language:** PHP 8.2+
- **Database:** MySQL / MariaDB / SQLite
- **Security & Permissions:** Spatie Laravel Permission
- **Frontend Styling:** Tailwind CSS, Alpine.js, Vanilla CSS, Google Cairo/Outfit Fonts
- **OAuth:** Laravel Socialite (Google OAuth)

---

## 🚀 كيفية التشغيل محلياً (Local Setup)

1. **استنسخ المستودع (Clone Repository):**
   ```bash
   git clone https://github.com/got713/EL-Malak-Careers.git
   cd EL-Malak-Careers
   ```

2. **تثبيت الاعتمادات (Install Dependencies):**
   ```bash
   composer install
   ```

3. **تجهيز البيئة (Environment Setup):**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **تشغيل قاعدة البيانات والتهيئة:**
   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```

5. **تشغيل السيرفر المحلي:**
   ```bash
   php artisan serve
   ```
   افتح المتصفح على: `http://127.0.0.1:8000`

---

## 🧪 إجراء الاختبارات الأمنية (Security Tests)

لتشغيل جناح الاختبارات الأمنية التلقائي:
```bash
./vendor/bin/phpunit tests/Feature/Security/
```

---

## 📄 الترخيص (License)

هذا المشروع خاص ومملوك لمنصة ملاك كاريرز (EL-Malak Careers). جميع الحقوق محفوظة.
