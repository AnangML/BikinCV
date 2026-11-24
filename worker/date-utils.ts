export interface CvPersonal {
  jobTitle?: string;
  summary?: string;
  location?: string;
  [key: string]: unknown;
}

export interface CvExperience {
  position?: string;
  location?: string;
  startDate?: string;
  endDate?: string;
  bullets?: string[];
  [key: string]: unknown;
}

export interface CvEducation {
  degree?: string;
  location?: string;
  startDate?: string;
  endDate?: string;
  [key: string]: unknown;
}

export interface CvCertification {
  name?: string;
  issuer?: string;
  issueDate?: string;
  expiryDate?: string;
  [key: string]: unknown;
}

export interface CvProject {
  role?: string;
  description?: string;
  [key: string]: unknown;
}

export interface CvTraining {
  title?: string;
  field?: string;
  subField?: string;
  location?: string;
  startDate?: string;
  endDate?: string;
  description?: string;
  [key: string]: unknown;
}

export interface CvLanguage {
  name?: string;
  level?: string;
  info?: string;
  [key: string]: unknown;
}

export interface CvPayload {
  personal?: CvPersonal;
  experiences?: CvExperience[];
  educations?: CvEducation[];
  certifications?: CvCertification[];
  projects?: CvProject[];
  trainings?: CvTraining[];
  languages?: CvLanguage[];
  [key: string]: unknown;
}

const SPECIAL_DURATION_RULES: Array<[RegExp, string]> = [
  [/\bseumur\s*hidup\b/gi, "Lifetime"],
  [/\b(sekarang|saat\s*ini)\b/gi, "Present"],
  [/\btanpa\s*kedaluwarsa\b/gi, "No Expiration"],
  [/\btanpa\s*batas\s*waktu\b/gi, "Permanent"],
];

const MONTH_RULES: Array<[RegExp, string]> = [
  [/\b(agu|agt|agustus)\b/gi, "Aug"],
  [/\b(okt|oktober)\b/gi, "Oct"],
  [/\b(des|desember)\b/gi, "Dec"],
  [/\b(mei)\b/gi, "May"],
  [/\b(maret|mar)\b/gi, "Mar"],
  [/\b(januari|jan)\b/gi, "Jan"],
  [/\b(februari|feb)\b/gi, "Feb"],
  [/\b(april|apr)\b/gi, "Apr"],
  [/\b(juni|jun)\b/gi, "Jun"],
  [/\b(juli|jul)\b/gi, "Jul"],
  [/\b(september|sep)\b/gi, "Sep"],
  [/\b(nopember|nop|november|nov)\b/gi, "Nov"],
];

/**
 * Konversi nama bulan dan istilah tanggal Bahasa Indonesia ke Bahasa Inggris standar.
 */
export function translateIndonesianDate(date: string): string {
  let text = date.trim();
  if (text === "") {
    return text;
  }

  for (const [pattern, replacement] of SPECIAL_DURATION_RULES) {
    text = text.replace(pattern, replacement);
  }

  for (const [pattern, replacement] of MONTH_RULES) {
    text = text.replace(pattern, replacement);
  }

  return text;
}

/**
 * Sanitasi semua tanggal dalam struktur CV ke format Bahasa Inggris standar.
 */
export function sanitizeAllDatesInCv(cv: CvPayload): CvPayload {
  const clone = structuredClone(cv);

  if (Array.isArray(clone.experiences)) {
    for (const exp of clone.experiences) {
      if (typeof exp.startDate === "string" && exp.startDate) {
        exp.startDate = translateIndonesianDate(exp.startDate);
      }
      if (typeof exp.endDate === "string" && exp.endDate) {
        exp.endDate = translateIndonesianDate(exp.endDate);
      }
    }
  }

  if (Array.isArray(clone.educations)) {
    for (const edu of clone.educations) {
      if (typeof edu.startDate === "string" && edu.startDate) {
        edu.startDate = translateIndonesianDate(edu.startDate);
      }
      if (typeof edu.endDate === "string" && edu.endDate) {
        edu.endDate = translateIndonesianDate(edu.endDate);
      }
    }
  }

  if (Array.isArray(clone.certifications)) {
    for (const cert of clone.certifications) {
      if (typeof cert.issueDate === "string" && cert.issueDate) {
        cert.issueDate = translateIndonesianDate(cert.issueDate);
      }
      if (typeof cert.expiryDate === "string" && cert.expiryDate) {
        cert.expiryDate = translateIndonesianDate(cert.expiryDate);
      }
    }
  }

  if (Array.isArray(clone.trainings)) {
    for (const train of clone.trainings) {
      if (typeof train.startDate === "string" && train.startDate) {
        train.startDate = translateIndonesianDate(train.startDate);
      }
      if (typeof train.endDate === "string" && train.endDate) {
        train.endDate = translateIndonesianDate(train.endDate);
      }
    }
  }

  return clone;
}
