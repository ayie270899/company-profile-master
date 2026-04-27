"use client";

import { useEffect, useState } from "react";
import Image from "next/image";
import axios from "axios";
import { Wrench, Mail, MapPin, Phone, GraduationCap, Menu, X, Camera, Image as ImageIcon } from "lucide-react";

export default function Home() {
  const [services, setServices] = useState([]);
  const [portfolios, setPortfolios] = useState([]);
  const [aboutPage, setAboutPage] = useState(null);
  const [visiMisiPage, setVisiMisiPage] = useState(null);
  const [termsPage, setTermsPage] = useState(null);
  const [privacyPage, setPrivacyPage] = useState(null);
  const [faqPage, setFaqPage] = useState(null);
  const [otherPages, setOtherPages] = useState([]);
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [formData, setFormData] = useState({ name: "", email: "", subject: "", message: "" });
  const [formStatus, setFormStatus] = useState("");
  const [selectedPortfolio, setSelectedPortfolio] = useState(null);
  const [lightboxImage, setLightboxImage] = useState(null);

  const apiUrl = process.env.NEXT_PUBLIC_API_URL || "http://company-profile-master.test/api/public";

  useEffect(() => {
    // Fetch data from Laravel API
    axios.get(`${apiUrl}/home`)
      .then((res) => {
        setServices(res.data.services || []);
        setPortfolios(res.data.portfolios || []);
        setAboutPage(res.data.aboutPage || null);
        setVisiMisiPage(res.data.visiMisiPage || null);
        setTermsPage(res.data.termsPage || null);
        setPrivacyPage(res.data.privacyPage || null);
        setFaqPage(res.data.faqPage || null);
        setOtherPages(res.data.otherPages || []);
      })
      .catch((err) => console.error("Failed to fetch data", err));
  }, [apiUrl]);

  const handleContactSubmit = async (e) => {
    e.preventDefault();
    setFormStatus("loading");
    try {
      const res = await axios.post(`${apiUrl}/contact`, formData, {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      });
      setFormStatus("success");
      setFormData({ name: "", email: "", subject: "", message: "" });
    } catch (err) {
      setFormStatus("error");
      console.error(err);
    }
  };

  const handleChange = (e) => setFormData({ ...formData, [e.target.name]: e.target.value });

  return (
    <>
      {/* Navigation */}
      <nav className="fixed top-0 w-full z-50 glass">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between h-16 items-center">
            <div className="flex items-center gap-2">
              <a href="#home" className="group flex items-center gap-2 font-bold text-xl tracking-tight text-orange-600 dark:text-orange-400">
                <img src="/dwiguna.png" alt="Logo SMK Dwiguna" className="h-12 w-auto drop-shadow-md" />
                SMK DWIGUNA
              </a>
            </div>
            <div className="hidden md:flex items-center space-x-2 text-sm font-medium">
              <a href="#home" className="px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">Home</a>
              <a href="#services" className="px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">Layanan</a>
              <a href="#portfolio" className="px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">Jurusan</a>
              <a href="#about" className="px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">Tentang</a>
              <a href="#contact" className="px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">Kontak</a>
              <div className="h-6 w-px bg-slate-200 dark:bg-slate-800 mx-2" />
              <a href={`${apiUrl.replace('/api/public', '')}/login`} className="text-orange-600 dark:text-orange-400 px-4 py-2 hover:bg-orange-50 dark:hover:bg-orange-900/30 rounded-lg transition-colors">Log in</a>
            </div>

            {/* Mobile Menu Button */}
            <div className="md:hidden flex items-center">
              <button 
                onClick={() => setIsMenuOpen(!isMenuOpen)}
                className="p-2 rounded-xl bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400 transition-all active:scale-95"
              >
                {isMenuOpen ? <X size={24} /> : <Menu size={24} />}
              </button>
            </div>
          </div>
        </div>

        {/* Mobile Menu Drawer */}
        {isMenuOpen && (
          <div className="md:hidden bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border-b border-slate-200 dark:border-slate-800 py-6 px-6 space-y-4 animate-in slide-in-from-top duration-300">
            <a href="#home" onClick={() => setIsMenuOpen(false)} className="block text-lg font-medium hover:text-orange-600 transition-colors">Home</a>
            <a href="#services" onClick={() => setIsMenuOpen(false)} className="block text-lg font-medium hover:text-orange-600 transition-colors">Layanan</a>
            <a href="#portfolio" onClick={() => setIsMenuOpen(false)} className="block text-lg font-medium hover:text-orange-600 transition-colors">Portfolio</a>
            <a href="#about" onClick={() => setIsMenuOpen(false)} className="block text-lg font-medium hover:text-orange-600 transition-colors">Tentang</a>
            <a href="#contact" onClick={() => setIsMenuOpen(false)} className="block text-lg font-medium hover:text-orange-600 transition-colors">Kontak</a>
            <div className="pt-4 border-t border-slate-100 dark:border-slate-800">
              <a 
                href={`${apiUrl.replace('/api/public', '')}/login`} 
                onClick={() => setIsMenuOpen(false)} 
                className="block w-full text-center px-4 py-4 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-2xl shadow-lg shadow-orange-500/20 transition-all"
              >
                Log in Ke Dashboard
              </a>
            </div>
          </div>
        )}
      </nav>

      {/* Hero Section */}
      <section id="home" className="relative min-h-screen flex items-center pt-20 overflow-hidden">
        <div className="absolute inset-0 z-0">
          <div className="absolute top-1/4 -left-20 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl animate-pulse"></div>
          <div className="absolute bottom-1/4 -right-20 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl animate-pulse" style={{ animationDelay: '700ms' }}></div>
        </div>

        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
          <div className="grid lg:grid-cols-2 gap-12 items-center">
            <div className="space-y-8">
              <h1 className="text-5xl lg:text-7xl font-extrabold tracking-tight leading-tight">
                Selamat Datang <span className="gradient-text">di SMK DWIGUNA, </span> Temukan potensi mu di SMK DWIGUNA
              </h1>
              <p className="text-lg text-slate-600 dark:text-slate-400 max-w-lg">
                Temukan potensi diri Anda di bidang teknologi bersama SMK DWIGUNA Depok.
              </p>
              <div className="flex flex-wrap gap-4">
                <a href="#contact" className="px-8 py-4 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-2xl shadow-xl shadow-orange-500/30 transition-all hover:-translate-y-1">
                  Konsultasi di sini
                </a>
                <a href="#portfolio" className="px-8 py-4 bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-900 dark:text-slate-100 font-semibold rounded-2xl transition-all">
                  Lihat Jurusan
                </a>
              </div>
            </div>
            <div className="hidden lg:block relative group">
              <div className="absolute -inset-1 bg-gradient-to-r from-orange-500 to-amber-500 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
              <Image
                src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2426&auto=format&fit=crop"
                alt="Hero Image"
                width={800}
                height={800}
                style={{ width: '100%', height: 'auto' }}
                className="relative rounded-3xl shadow-2xl object-cover aspect-square"
              />
            </div>
          </div>
        </div>
      </section>

      {/* Services Section */}
      <section id="services" className="py-24 bg-white dark:bg-slate-900/50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center space-y-4 mb-16">
            <h3 className="text-sm text-orange-600 dark:text-orange-400 font-semibold tracking-wider uppercase">Layanan Kami</h3>
            <h2 className="text-3xl md:text-4xl font-bold">Solusi Terbaik Untuk Bisnis Anda</h2>
          </div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            {services.map((service) => (
              <div key={service.id} className="group p-8 bg-slate-50 dark:bg-slate-800 rounded-3xl border border-transparent hover:border-orange-500 transition-all duration-300 hover:shadow-2xl hover:shadow-orange-500/10">
                <div className="w-14 h-14 bg-orange-100 dark:bg-orange-900/50 flex items-center justify-center rounded-2xl mb-6 group-hover:scale-110 transition-transform">
                  {service.icon_image ? (
                    <img 
                      src={service.icon_image.startsWith('http') ? service.icon_image : `http://company-profile-master.test${service.icon_image}`} 
                      alt={service.title} 
                      className="w-8 h-8 object-contain" 
                    />
                  ) : (
                    <Wrench className="w-8 h-8 text-orange-600 dark:text-orange-400" />
                  )}
                </div>
                <h3 className="text-xl font-bold mb-3">{service.title}</h3>
                <p className="text-slate-600 dark:text-slate-400 line-clamp-3">
                  {service.short_desc}
                </p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Jurusan Section */}
      <section id="portfolio" className="py-24">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex flex-col mb-16 gap-4">
            <h3 className="text-sm text-orange-600 dark:text-orange-400 font-semibold tracking-wider uppercase">Jurusan</h3>
            <h2 className="text-3xl md:text-4xl font-bold">Jurusan yang Tersedia</h2>
          </div>

          <div className="grid md:grid-cols-2 gap-8">
            {portfolios.map((portfolio) => (
              <div 
                key={portfolio.id} 
                className="group relative overflow-hidden rounded-3xl bg-slate-200 dark:bg-slate-800 cursor-pointer"
                onClick={() => setSelectedPortfolio(portfolio)}
              >
                <div className="w-full aspect-video overflow-hidden bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                  {(portfolio.main_image_url || portfolio.image) ? (
                    <img
                      src={portfolio.main_image_url ? `${apiUrl.replace('/api/public', '')}/storage/${portfolio.main_image_url}` : (portfolio.image.startsWith('http') ? portfolio.image : `http://company-profile-master.test${portfolio.image}`)}
                      alt={portfolio.title}
                      className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    />
                  ) : (
                    <div className="flex flex-col items-center gap-2 text-slate-400 -mt-4">
                      <Camera size={40} strokeWidth={1.5} />
                      <span className="text-sm font-bold opacity-75">Foto Belum Tersedia</span>
                    </div>
                  )}
                </div>
                <div className="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent flex flex-col justify-end p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform">
                  <span className="text-sm text-orange-400 font-medium mb-2">{portfolio.project_date}</span>
                  <h3 className="text-2xl text-white font-bold mb-2">{portfolio.title}</h3>
                  <div className="flex items-center gap-2 text-xs text-white/70 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span>Lihat Detail</span>
                    <Wrench className="w-3 h-3 rotate-45" />
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* About Us Section */}
      {aboutPage && (
        <section id="about" className="py-24 bg-orange-600 text-white overflow-hidden relative">
          <div className="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[600px] h-[600px] bg-white/10 rounded-full blur-3xl"></div>
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div className="grid lg:grid-cols-2 gap-16 items-center">
              <div className="space-y-8">
                <h3 className="text-sm text-orange-200 font-semibold tracking-wider uppercase">Tentang Sekolah</h3>
                <h2 className="text-4xl lg:text-5xl text-white font-bold leading-tight">{aboutPage.title}</h2>
                <div className="text-orange-100 lg:text-lg leading-relaxed space-y-4 whitespace-pre-wrap">
                  {aboutPage.content}
                </div>
              </div>
              <div className="relative">
                <div className="absolute -inset-4 bg-white/20 rounded-3xl blur animate-pulse"></div>
                <img
                  // src={aboutPage.featured_image || "https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2670&auto=format&fit=crop"}
                  src="/dwiguna.png"
                  alt="About Us"
                  className="relative rounded-3xl shadow-2xl w-full h-auto"
                />
              </div>
            </div>
          </div>
        </section>
      )}

      {/* Visi Misi Section */}
      {visiMisiPage && (
        <section className="py-24 bg-white dark:bg-slate-900">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="grid lg:grid-cols-2 gap-16 items-center">
              <div className="order-2 lg:order-1 relative">
                <div className="absolute -inset-4 bg-orange-500/10 rounded-3xl blur"></div>
                <img
                  src="/dwiguna.png"
                  alt="Visi Misi"
                  className="relative rounded-3xl shadow-xl w-full h-auto"
                />
              </div>
              <div className="order-1 lg:order-2 space-y-8">
                <h3 className="text-sm text-orange-600 font-semibold tracking-wider uppercase">Visi & Misi</h3>
                <h2 className="text-4xl font-bold leading-tight text-slate-900 dark:text-white">{visiMisiPage.title}</h2>
                <div className="text-slate-600 dark:text-slate-400 lg:text-lg leading-relaxed space-y-4 whitespace-pre-wrap">
                  {visiMisiPage.content}
                </div>
              </div>
            </div>
          </div>
        </section>
      )}

      {/* Konsultasi Section */}
      <section id="contact" className="py-24 bg-white dark:bg-slate-950">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center space-y-4 mb-16">
            <h3 className="text-sm text-orange-600 dark:text-orange-400 font-semibold tracking-wider uppercase">Konsultasi</h3>
            <h2 className="text-3xl md:text-4xl font-bold">Mari Kita Diskusikan</h2>
          </div>

          <div className="grid lg:grid-cols-5 gap-12">
            <div className="lg:col-span-2 space-y-8">
              <div className="flex gap-6 items-start">
                <div className="w-12 h-12 bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center rounded-2xl shrink-0">
                  <Mail className="w-6 h-6 text-orange-600 dark:text-orange-400" />
                </div>
                <div>
                  <h3 className="text-lg font-bold mb-1">Email</h3>
                  <p className="text-slate-600 dark:text-slate-400">ayie270899@gmail.com</p>
                </div>
              </div>
              <div className="flex gap-6 items-start">
                <div className="w-12 h-12 bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center rounded-2xl shrink-0">
                  <MapPin className="w-6 h-6 text-orange-600 dark:text-orange-400" />
                </div>
                <div>
                  <h3 className="text-lg font-bold mb-1">Kantor</h3>
                  <p className="text-slate-600 dark:text-slate-400">Jl. Raya Citayam No. 123, Depok</p>
                </div>
              </div>
              <div className="flex gap-6 items-start">
                <div className="w-12 h-12 bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center rounded-2xl shrink-0">
                  <Phone className="w-6 h-6 text-orange-600 dark:text-orange-400" />
                </div>
                <div>
                  <h3 className="text-lg font-bold mb-1">WhatsApp</h3>
                  <p className="text-slate-600 dark:text-slate-400">0889-0111-5574</p>
                </div>
              </div>
            </div>

            <div className="lg:col-span-3">
              <form onSubmit={handleContactSubmit} className="space-y-6">
                <div className="p-8 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-xl">
                  {formStatus === "success" && (
                    <div className="p-4 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-xl border border-emerald-500/20 mb-6 font-medium">
                      Pesan Anda telah terkirim!
                    </div>
                  )}
                  {formStatus === "error" && (
                    <div className="p-4 bg-red-500/10 text-red-600 dark:text-red-400 rounded-xl border border-red-500/20 mb-6 font-medium">
                      Gagal mengirim pesan. Silakan coba lagi.
                    </div>
                  )}

                  <div className="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                      <label className="block text-sm font-medium mb-2">Nama Lengkap</label>
                      <input type="text" name="name" value={formData.name} onChange={handleChange} required className="w-full px-4 py-3 bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-shadow" placeholder="Masukkan nama Anda" />
                    </div>
                    <div>
                      <label className="block text-sm font-medium mb-2">Email</label>
                      <input type="email" name="email" value={formData.email} onChange={handleChange} required className="w-full px-4 py-3 bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-shadow" placeholder="Masukkan email Anda" />
                    </div>
                  </div>

                  <div className="mb-6">
                    <label className="block text-sm font-medium mb-2">Subjek</label>
                    <input type="text" name="subject" value={formData.subject} onChange={handleChange} required className="w-full px-4 py-3 bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-shadow" placeholder="Subjek pesan" />
                  </div>

                  <div className="mb-6">
                    <label className="block text-sm font-medium mb-2">Pesan</label>
                    <textarea name="message" value={formData.message} onChange={handleChange} rows="4" required className="w-full px-4 py-3 bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-shadow" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                  </div>

                  <button type="submit" disabled={formStatus === "loading"} className="w-full py-4 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-xl transition-colors disabled:opacity-70 flex justify-center items-center">
                    {formStatus === "loading" ? "Mengirim..." : "Kirim Pesan"}
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

      {/* FAQ Section */}
      {faqPage && (
        <section id="faq" className="py-24 bg-slate-50 dark:bg-slate-900/50">
          <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="text-center mb-12">
              <h3 className="text-sm text-orange-600 font-semibold tracking-wider uppercase">Pertanyaan Umum</h3>
              <h2 className="text-3xl font-bold mt-2">{faqPage.title}</h2>
            </div>
            <div className="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl border border-slate-100 dark:border-slate-700">
                  <div className="text-slate-600 dark:text-slate-400 leading-relaxed whitespace-pre-wrap">
                    {faqPage.content}
                  </div>
            </div>
          </div>
        </section>
      )}

      {/* Dynamic Additional Pages Section */}
      {otherPages.map((page) => (
        <section key={page.id} id={page.slug} className="py-24 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="grid lg:grid-cols-2 gap-16 items-center">
              <div className="space-y-8">
                <h3 className="text-sm text-orange-600 font-semibold tracking-wider uppercase">Informasi</h3>
                <h2 className="text-4xl font-bold leading-tight text-slate-900 dark:text-white">{page.title}</h2>
                <div className="text-slate-600 dark:text-slate-400 lg:text-lg leading-relaxed space-y-4 whitespace-pre-wrap">
                  {page.content}
                </div>
              </div>
              <div className="relative group">
                <div className="absolute -inset-4 bg-gradient-to-tr from-orange-500/20 to-amber-500/20 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                <img
                  src={page.featured_image || "https://picsum.photos/seed/smkdwiguna/800/600"}
                  alt={page.title}
                  className="relative rounded-3xl shadow-2xl w-full h-[400px] object-cover bg-slate-100 dark:bg-slate-800 transition-all duration-500 group-hover:scale-[1.02]"
                />
              </div>
            </div>
          </div>
        </section>
      ))}

      {/* Legal Information Section */}
      {(termsPage || privacyPage) && (
        <section className="py-16 border-t border-slate-200 dark:border-slate-800">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="grid md:grid-cols-2 gap-12">
              {termsPage && (
                <div className="space-y-4">
                  <h3 className="font-bold text-lg text-orange-600">{termsPage.title}</h3>
                  <div className="text-sm text-slate-500 dark:text-slate-400 whitespace-pre-wrap">
                    {termsPage.content}
                  </div>
                </div>
              )}
              {privacyPage && (
                <div className="space-y-4">
                  <h3 className="font-bold text-lg text-orange-600">{privacyPage.title}</h3>
                  <div className="text-sm text-slate-500 dark:text-slate-400 whitespace-pre-wrap">
                    {privacyPage.content}
                  </div>
                </div>
              )}
            </div>
          </div>
        </section>
      )}

      {/* Portfolio Detail Modal */}
      {selectedPortfolio && (
        <div className="fixed inset-0 z-[60] flex items-center justify-center p-4 sm:p-6 bg-slate-950/80 backdrop-blur-md animate-in fade-in duration-300">
          {/* Fixed Close Button (Top right of screen) */}
          <button 
            onClick={() => setSelectedPortfolio(null)}
            className="fixed top-6 right-6 z-[100] p-4 bg-white/10 hover:bg-white/25 text-white backdrop-blur-xl border border-white/20 rounded-full shadow-2xl transition-all hover:rotate-90 hover:scale-110 active:scale-95 active:bg-orange-600 active:border-orange-500"
            title="Tutup (Esc)"
          >
            <X size={28} strokeWidth={3} />
          </button>
          <div className="bg-white dark:bg-slate-900 w-full max-w-4xl max-h-[90vh] rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col relative group transition-all transform scale-100 animate-in zoom-in-95 duration-300">
            <div className="overflow-y-auto custom-scrollbar">
              {/* Image Banner / Gallery */}
              <div className="relative h-72 sm:h-96 w-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                {(selectedPortfolio.main_image_url || selectedPortfolio.image) ? (
                  <>
                    <img 
                      src={selectedPortfolio.main_image_url ? `${apiUrl.replace('/api/public', '')}/storage/${selectedPortfolio.main_image_url}` : selectedPortfolio.image} 
                      alt={selectedPortfolio.title}
                      className="w-full h-full object-cover"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-white dark:from-slate-900 via-transparent to-transparent"></div>
                  </>
                ) : (
                  <div className="flex flex-col items-center gap-4 text-slate-400">
                    <div className="p-6 rounded-full bg-slate-200 dark:bg-slate-700/50">
                      <Camera size={48} strokeWidth={1.5} />
                    </div>
                    <span className="font-bold tracking-tight text-lg">Foto Belum Tersedia</span>
                  </div>
                )}
              </div>

              {/* Content */}
              <div className="px-8 pb-12 -mt-16 relative z-10">
                <div className="inline-flex items-center gap-2 px-5 py-2.5 bg-orange-600 text-white text-xs font-bold rounded-full mb-6 shadow-xl shadow-orange-500/40 uppercase tracking-widest">
                  Profil Jurusan
                </div>
                <h2 className="text-4xl sm:text-5xl font-black mb-4 tracking-tight">{selectedPortfolio.title}</h2>
                <div className="flex flex-wrap items-center gap-6 text-slate-500 dark:text-slate-400 mb-10 border-b border-slate-100 dark:border-slate-800 pb-8">
                  <span className="flex items-center gap-2 bg-slate-50 dark:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-100 dark:border-slate-700 italic">
                    <GraduationCap size={18} className="text-orange-500" /> SMK Dwiguna
                  </span>
                  <span className="flex items-center gap-2 font-bold text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20 px-3 py-1.5 rounded-lg">
                    {selectedPortfolio.project_date}
                  </span>
                </div>

                <div className="grid lg:grid-cols-3 gap-12">
                  <div className="lg:col-span-2 space-y-8">
                    <div>
                      <h3 className="text-2xl font-black mb-6 flex items-center gap-3">
                         <div className="w-2 h-8 bg-orange-500 rounded-full" />
                         Sekilas Tentang Jurusan
                      </h3>
                      <div className="text-slate-600 dark:text-slate-300 leading-[1.8] font-medium whitespace-pre-wrap text-lg md:text-xl">
                        {selectedPortfolio.full_content || selectedPortfolio.short_desc}
                      </div>
                    </div>
                  </div>

                  <div className="space-y-8">
                    <h3 className="text-2xl font-black flex items-center gap-3">
                       <div className="w-2 h-8 bg-orange-500 rounded-full" />
                       Galeri Foto
                    </h3>
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-6">
                      {(selectedPortfolio.gallery && selectedPortfolio.gallery.length > 0) ? selectedPortfolio.gallery.map((img, i) => (
                        <div key={i} onClick={() => setLightboxImage(img)} className="flex flex-col gap-3 group cursor-pointer lg:pb-4 border-b border-slate-100 dark:border-slate-800 last:border-0 pb-6">
                          <div className="aspect-[4/3] rounded-3xl overflow-hidden border-4 border-white dark:border-slate-800 shadow-xl group-hover:shadow-orange-500/20 group-hover:border-orange-500/50 transition-all duration-500">
                            <img src={img.url} alt={`${selectedPortfolio.title} ${i}`} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                          </div>
                          {img.caption && (
                            <p className="text-sm text-slate-500 dark:text-slate-400 text-center font-bold px-4 leading-snug">
                              {img.caption}
                            </p>
                          )}
                        </div>
                      )) : (
                        <div className="col-span-1 py-12 bg-slate-50 dark:bg-slate-800/30 rounded-3xl text-center border-2 border-dashed border-slate-200 dark:border-slate-700 text-slate-400 font-medium">
                          Belum ada foto galeri tambahan
                        </div>
                      )}
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      )}

      {/* Lightbox Modal */}
      {lightboxImage && (
        <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm" onClick={() => setLightboxImage(null)}>
          <button 
            onClick={() => setLightboxImage(null)}
            className="absolute top-4 right-4 p-3 bg-white/10 hover:bg-white/20 text-white rounded-full transition-colors"
          >
            <X size={24} />
          </button>
          
          <div className="relative max-w-5xl w-full max-h-[90vh] flex flex-col items-center justify-center" onClick={(e) => e.stopPropagation()}>
            <img 
              src={lightboxImage.url} 
              alt="Gallery Preview" 
              className="max-w-full max-h-[80vh] object-contain rounded-xl border border-white/10 shadow-2xl"
            />
            {lightboxImage.caption && (
              <div className="mt-6 text-white text-base md:text-lg tracking-wide text-center drop-shadow-md">
                {lightboxImage.caption}
              </div>
            )}
          </div>
        </div>
      )}

      {/* Footer */}
      <footer className="py-12 border-t border-slate-200 dark:border-slate-800 text-center">
        <div className="max-w-7xl mx-auto px-4">
          <p className="text-sm text-slate-500">&copy; {new Date().getFullYear()} SMK DWIGUNA. All rights reserved.</p>
        </div>
      </footer>
    </>
  );
}
